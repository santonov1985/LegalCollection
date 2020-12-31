<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Http\Helpers\UsersHelper;
use App\Http\Requests\NotaryTable\Parsing;
use App\Http\Requests\NotaryTable\Store;
use App\Http\Requests\NotaryTable\Update;
use Box\Spout\Writer\Style\StyleBuilder;
use Core\Settings\Notary\DefaultSetting;
use Core\Tables\Notaries\NotaryTable;
use Core\Tables\Notaries\NotaryRepository;
use Core\Tables\Notaries\NotaryService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;
use Core\Directories\Notaries\Notary;


class NotaryController extends Controller
{
    protected $service;
    protected $repository;

    public function __construct(
        NotaryService $notaryTableService,
        NotaryRepository $notaryTableRepository
    ) {
        $this->service = $notaryTableService;
        $this->repository = $notaryTableRepository;
    }

    public function index()
    {
        //$notaries - для отображение Нотариусов в Фильтре
        $notaries = Notary::all();

        $notariesTable = NotaryTable::withTrashed()
            ->orderByDesc('updated_at')
            ->paginate(20);

        return view('tables.notary.index',compact('notariesTable','notaries'));
    }

    public function create()
    {
        $nowDate = Carbon::now()->format("Y-m-d");
        $notary_costs = DefaultSetting::get(['notary_cost']);
        $notaries = Notary::all();
        return view('tables.notary.create',compact(
              'notary_costs',
            'notaries',
                      'nowDate'));
    }

    public function store(Store $request)
    {
        $homePhone = UsersHelper::getActualPhone($request->input('home_phone'));
        $mobilePhone = UsersHelper::getActualPhone($request->input('mobile_phone'));
        $workPhone = UsersHelper::getActualPhone($request->input('work_phone'));

        $total = $this->service->getTotal(
            $request->input('delayed_od'),
            $request->input('delayed_prc'),
            $request->input('delayed_fines'),
            $request->input('notary_cost')
        );

        try {
            $this->repository->createNotary(
                $request->input('number_loan'),
                $request->input('iin'),
                $request->input('identification'),
                $request->input('full_name'),
                $mobilePhone,
                $request->notary_id,
                $request->input('date_of_issue'),
                $request->input('loan_term'),
                $request->input('issued_amount'),
                $request->input('delayed_od'),
                $request->input('delayed_prc'),
                $request->input('delayed_fines'),
                $request->input('number_of_day_overdue'),
                $total,
                $request->input('transfer_date'),
                $request->input('notary_cost'),
                $request->input('email'),
                $request->input('residence_address'),
                $request->input('place_of_residence'),
                $homePhone,
                $workPhone
            );

            return redirect()->route('table-notary-index')->with('message', 'Добавлено!');
        }catch (\Throwable $err){
            Log::error("Directories: add new NotaryTable-table error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors(['Ошибка добавления']);
        }
    }

    public function edit(int $id)
    {
        $notaries = Notary::all();
        $notaries_table = NotaryTable::query()->findOrFail($id);
        return view('tables.notary.edit', compact('notaries_table', 'notaries'));
    }

    public function update(
        Update $request,
        int $id) {

        $mobilePhone = UsersHelper::getActualPhone($request->input('mobile_phone'));
        $homePhone = UsersHelper::getActualPhone($request->input('home_phone'));
        $workPhone = UsersHelper::getActualPhone($request->input('work_phone'));

        $notary = NotaryTable::query()->findOrFail($id);

        $total = $this->service->getTotal(
            $request->input('delayed_od'),
            $request->input('delayed_prc'),
            $request->input('delayed_fines'),
            $request->input('notary_cost')
        );

        try {
            $this->repository->updateNotary(
                $notary,
                $request->input('number_loan'),
                $request->input('iin'),
                $request->input('identification'),
                $request->input('full_name'),
                $mobilePhone,
                $request->notary_id,
                $request->input('date_of_issue'),
                $request->input('loan_term'),
                $request->input('issued_amount'),
                $request->input('delayed_od'),
                $request->input('delayed_prc'),
                $request->input('delayed_fines'),
                $request->input('number_of_day_overdue'),
                $total,
                $request->input('transfer_date'),
                $request->input('notary_cost'),
                $request->input('email'),
                $request->input('residence_address'),
                $request->input('place_of_residence'),
                $homePhone,
                $workPhone
            );

            return redirect()->route('table-notary-index')->with('message', 'Сохранено!');

        }catch (\Throwable $err){
            Log::error("Directories: update NotaryTable-table error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors(['Ошибка сохранения']);
        }
    }

    public function import()
    {
        $defaultSettings  = DefaultSetting::query()->pluck('notary_cost');

        if ($defaultSettings[0] === '0') {
            return redirect()->back()->withErrors(['Укажите сумму Нотариальных расходов']);
        }

        $notaries = Notary::all();
        return view('tables.notary.import', compact('notaries'));
    }

    public function parsing(Parsing $request)
    {
        //получаем Нотариальные расходы с базы default_settings
        $notary_cost = DefaultSetting::query()->where('id', '1')->value('notary_cost');

        // импорт excel файла
        if ($request->hasFile('excelFile')) {
            $collections = (new FastExcel)->withoutHeaders()->import($request->file('excelFile'));

            foreach ($collections as $key => $collection) {
                if (!empty($collection[0]) && is_numeric($collection[0])) {
                    if ($collection[23] >= $request->dayOfOverdue) {

                    // приводим номера телефонов в правельный вид
                    $homePhone = UsersHelper::getActualPhone($collection[6]);
                    $mobilePhone = UsersHelper::getActualPhone($collection[7]);
                    $workPhone = UsersHelper::getActualPhone($collection[8]);

                    // получаем сумму 4-х полей (Просрочка ОД, Просрочка %, Просрочка штрафы и Общая сумма с Нот. расх)
                    $total = $this->service->getTotal(
                        $collection[15],
                        $collection[16],
                        $collection[17],
                        $notary_cost
                    );
                        // пропускаем повторяющиеся данные
                        $getRepeat = NotaryTable::query()->where('number_loan', $collection[0])->first();
                        if ($getRepeat !== null) {
                            continue;
                        }

                    try {
                        $this->repository->createNotary(
                            $collection[0],
                            $collection[2],
                            $collection[3],
                            $collection[4],
                            $mobilePhone,
                            $request->notary_id,
                            $date_of_issue = Carbon::parse($collection[11])->format("Y-m-d"),
                            $collection[12],
                            $collection[14],
                            $collection[15],
                            $collection[16],
                            $collection[17],
                            $collection[23],
                            $total,
                            $transferDate = Carbon::now()->format("Y-m-d"),
                            $notary_cost,
                            $collection[5],
                            $collection[10],
                            $collection[9],
                            $homePhone,
                            $workPhone
                        );

                    }catch (\Throwable $err){
                        Log::error("Directories: Error adding imported file. " . $err->getMessage() . $err->getTraceAsString());
                        return redirect()->back()->withErrors(['Ошибка сохранения']);
                    }
                    }
                }
            }
            return redirect()->route('table-notary-index')->with('message', 'Сохранено!');
        }
    }

    public function destroy(int $id)
    {
        $notary = NotaryTable::query()->findOrFail($id);
        $notary->delete();

        return redirect()->back();
    }

    public function restore(int $id)
    {
        $notary = NotaryTable::withTrashed()->findOrFail($id);
        $notary->restore();

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $rules = [
            'search'    => 'nullable|string|min:1|max:100',
            'notary'   => 'nullable|numeric',
            'transfer_date'    => 'nullable|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        //получаем коллекцию Нотариусов
        $notaries = Notary::all();

        //получаем дату передачи Нотариусу
        $dates = NotaryTable::all()->pluck('transfer_date');

        $notary = null;
        if (!empty($request->input('notary'))) {
            //получаем сущность найденную в коллекции Нотариус
            $notary = Notary::query()->findOrFail($request->input('notary'));
        }

        try {
            $notaryTablesSearches = $this->repository->getSearch(
                $request->input('search'),
                $notary,
                $request->input('transfer_date')
            );

            return view('tables.notary.search', compact(
                'notaryTablesSearches',
                'notaries',
                'dates'
            ));

        }catch (\Throwable $err) {
            Log::error("NotaryTables: Filtering error in NotaryTables. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withInput()->withErrors(['Ошибка поиска']);
        }
    }

    public function export()
    {
        //Устанавливаем цвет заливки и размер шрифта заголовка
        $header_style = (new StyleBuilder())
            ->setFontSize(10)
            ->setBackgroundColor("ffff00")
            ->build();

        //Устанавливаем размер шрифта основного текста
        $rows_style = (new StyleBuilder())
            ->setFontSize(10)
            ->build();

        //Получаем данные для Экспорта из строки запроса
        $data = request()->query('data');

        if (!empty($data)) {

            if (empty($data['search'])) {
                $data['search'] = null;
            }
            if (empty($data['transfer_date'])) {
                $data['transfer_date'] = null;
            }

            $notary = null;
            if (!empty($data['notary'])) {
                $notary = Notary::query()->findOrFail($data['notary']);
            }

           $notaryTablesSearches = $this->repository->getSearch(
               $data['search'],
               $notary,
               $data['transfer_date']
           );

            $item = collect([]);

            foreach ($notaryTablesSearches as $items) {
                $item->push(
                    [
                        'Номер займа' => $items['number_loan'],
                        'ИИН' => $items['iin'],
                        'Уд.личности' => $items['identification'],
                        'Ф.И.О' => $items['full_name'],
                        'Мобильный телефон' => $items['mobile_phone'],
                        'Срок займа' => $items['loan_term'],
                        'Выданная сумма' => $items['issued_amount'],
                        'День просрочки' => $items['number_of_day_overdue'],
                        'Просрочка ОД' => $items['delayed_od'],
                        'Просрочка %' => $items['delayed_prc'],
                        'Просрочка штрафы' => $items['delayed_fines'],
                        'Сумма по исполнительной надписи' => $items['total'],
                        'Нотартальные расходы' => $items['notary_cost'],
                        'Общая сумма с нотариальными расходами' => $items['total_with_notary_cost'],
                        'Статус' => $items['key_status'],
                        'Погашение' => $items['part_payment'],
                    ]
                );

                (new FastExcel($item))
                    ->headerStyle($header_style)
                    ->rowsStyle($rows_style)
                    ->export('export.xlsx');
            }

            return redirect()->back()->with('message', 'Файл выгружен!');
        }
        return redirect()->back()->with('message', 'Данные отсутствуют');
    }

    public function check()
    {
        $dataSearch = request()->query('dataSearch');
        return view('tables.notary.check',compact('dataSearch'));
    }

    public function parseCheck(Request $request)
    {
        $rules = [
            'checkFile'    => 'required|mimes:xlsx'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        if ($request->hasFile('checkFile')) {
            $fileForChecks = (new FastExcel)->withoutHeaders()->import($request->file('checkFile'));

            foreach ($fileForChecks as $fileForCheck) {
                if (!empty($fileForCheck[0]) && is_numeric($fileForCheck[0])) {

                    $getEntity = NotaryTable::query()->where('number_loan', $fileForCheck[0])->first();

                    if ($getEntity !== null) {
                        $this->repository->addingToDBCheckData(
                            $getEntity,
                            $fileForCheck[30],
                            $fileForCheck[33]
                        );
                    }
                }
            }
            return redirect()->route('table-notary-search', $request->query())->with('message', 'Данные добавленны!');
        }
        return redirect()->back()->with('message', 'Файл не выбран');

    }

}
