<?php

namespace App\Http\Controllers\Directories;

use App\Http\Helpers\UsersHelper;
use App\Http\Requests\Notary\Store;
use Core\Directories\Notaries\Notary;
use Core\Directories\Notaries\NotaryRepository;
use App\Http\Controllers\Controller;
use Core\Directories\Notaries\NotaryService;
use Illuminate\Support\Facades\Log;

class NotaryController extends Controller
{
    protected $service;
    protected $repository;

    public function __construct(
        NotaryService $notaryService,
        NotaryRepository $notaryRepository
    ) {
        $this->service      = $notaryService;
        $this->repository   = $notaryRepository;
    }

    public function index()
    {
        $notaries = Notary::withTrashed()
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('directories.notary.index',compact('notaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('directories.notary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        $phone = UsersHelper::getActualPhone($request->input('phone'));

        $phoneWithFirstNumeral = $this->service->addFirstNumber($phone);

        try {

            $this->repository->createNotary(
                $request->input('title'),
                $request->input('email'),
                $phoneWithFirstNumeral,
                $request->input('description')
            );

            return redirect()->route('notary-index')->with('message', 'Добавлено!');
        }catch (\Throwable $err){
            Log::error("Directories: add new Notary error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors(['Ошибка добавления']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $notaries = Notary::query()->findOrFail($id);
        return view('directories.notary.edit', compact('notaries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Store $request, int $id)
    {
        $phone = UsersHelper::getActualPhone($request->input('phone'));

        if (!empty($phone))
        {
            $phoneWithFirstNumeral = $this->service->addFirstNumber($phone);
        }


        try {
            $notary = Notary::query()->findOrFail($id);
            $this->repository->updateNotary(
                $notary,
                $request->input('title'),
                $request->input('email'),
                $phoneWithFirstNumeral,
                $request->input('description')
            );

            return redirect()->route('notary-index')->with('message', 'Сохранено!');

        }catch (\Throwable $err){
            Log::error("Directories: update Notary error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors(['Ошибка сохранения']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
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
}
