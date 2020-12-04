<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Http\Helpers\UsersHelper;
use App\Http\Requests\NotaryTable\Parsing;
use App\Http\Requests\NotaryTable\Store;
use App\Http\Requests\NotaryTable\Update;
use Core\Settings\Notary\DefaultSetting;
use Core\Tables\Notaries\Notary;
use Core\Tables\Notaries\NotaryRepository;
use Core\Tables\Notaries\NotaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;

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
        $notaries_table = Notary::withTrashed()
            ->orderByDesc('updated_at')
            ->paginate(20);

        return view('tables.notary.index',compact('notaries_table'));
    }

    public function create()
    {
        $notary_costs = DefaultSetting::get(['notary_cost']);
        return view('tables.notary.create',compact('notary_costs'));
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
            Log::error("Directories: add new Notary-table error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors(['Ошибка добавления']);
        }
    }

    public function edit(int $id)
    {
        $notaries_table = Notary::query()->findOrFail($id);
        return view('tables.notary.edit', compact('notaries_table'));
    }

    public function update(
        Update $request,
        int $id) {

        $mobilePhone = UsersHelper::getActualPhone($request->input('mobile_phone'));
        $homePhone = UsersHelper::getActualPhone($request->input('home_phone'));
        $workPhone = UsersHelper::getActualPhone($request->input('work_phone'));

        $notary = Notary::query()->findOrFail($id);
//        $notary = Notary::query()->updateOrCreate()->findOrFail($id);

        $total = $this->service->getTotal(
            $request->input('delayed_od'),
            $request->input('delayed_prc'),
            $request->input('delayed_fines'),
            $request->input('notary_cost')
        );

        // (new TablesHelper)->numericClear($request->input('issued_amount'));

        try {
            $this->repository->updateNotary(
                $notary,
                $request->input('number_loan'),
                $request->input('iin'),
                $request->input('identification'),
                $request->input('full_name'),
                $mobilePhone,
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
            Log::error("Directories: update Notary-table error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors(['Ошибка сохранения']);
        }
    }

    public function import()
    {
        return view('tables.notary.import');
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

                        $getRepeat = Notary::query()->where('number_loan', $collection[0])->first();
                        if ($getRepeat != null) {
                            continue;
                        }

                    try {
                        $this->repository->createNotary(
                            $collection[0],
                            $collection[2],
                            $collection[3],
                            $collection[4],
                            $mobilePhone,
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
        $notary = Notary::query()->findOrFail($id);
        $notary->delete();

        return redirect()->back();
    }

    public function restore(int $id)
    {
        $brand = Notary::withTrashed()->findOrFail($id);
        $brand->restore();

        return redirect()->back();
    }
    public function search(Request $request)
    {
    $notaryTablesSearches = Notary::withTrashed()
        ->where('number_loan', 'like', $request->input('search'))
        ->orWhere('iin', 'like', $request->input('search'))
        ->orWhere('identification', 'like', $request->input('search'))
        ->orWhere('full_name', 'like', '%' .$request->input('search'). '%')
        ->orderByDesc('created_at')
        ->get();
    return view('tables.notary.search', compact('notaryTablesSearches'));
    }

}
