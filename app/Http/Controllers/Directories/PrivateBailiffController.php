<?php

namespace App\Http\Controllers\Directories;

use App\Http\Helpers\UsersHelper;
use App\Http\Requests\PrivateBailiff\Store;
use Core\Directories\PrivateBailiff\PrivateBailiff;
use Core\Directories\PrivateBailiff\PrivateBailiffRepository;
use App\Http\Controllers\Controller;
use Core\Directories\PrivateBailiff\PrivateBailiffService;
use Illuminate\Support\Facades\Log;

class PrivateBailiffController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(
        PrivateBailiffRepository $notaryRepository,
        PrivateBailiffService $notaryService
    ) {
        $this->repository = $notaryRepository;
        $this->service = $notaryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $privateBailiffs = PrivateBailiff::withTrashed()
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('directories.privateBailiff.index', compact('privateBailiffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('directories.privateBailiff.create');
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

            $this->repository->createPrivateBailiff(
                $request->input('title'),
                $request->input('email'),
                $phoneWithFirstNumeral,
                $request->input('description')
            );

            return redirect()->route('privateBailiff-index')->with('message', 'Добавлено');
        }catch (\Throwable $err){
            Log::error("Directories: add new PrivateBailiff error.", [
                $err->getMessage(),
                $err->getTrace()
            ]);

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
        $privateBailiff = PrivateBailiff::query()->findOrFail($id);

        return view('directories.privateBailiff.edit', compact('privateBailiff'));
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
            $photoFirstNumber = $this->service->addFirstNumber($phone);
        }


        try {
            $publicBailiff = PrivateBailiff::query()->findOrFail($id);

           $this->repository->updatePrivateBailiff(
                $publicBailiff,
                $request->input('title'),
                $request->input('email'),
                $photoFirstNumber,
                $request->input('description')
            );

            return redirect()->route('privateBailiff-index')->with('message', 'Сохранено');
        }catch (\Throwable $err){
            Log::error("Directories: update PrivateBailiff error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors(['Ошибка добавления']);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $publicBailiff = PrivateBailiff::query()->findOrFail($id);
        $publicBailiff->delete();

        return redirect()->back();
    }

    public function restore(int $id)
    {
        $publicBailiff = PrivateBailiff::withTrashed()->findOrFail($id);
        $publicBailiff->restore();

        return redirect()->back();
    }
}
