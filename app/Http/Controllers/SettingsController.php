<?php

namespace App\Http\Controllers;
use App\Http\Requests\NotarySetting\Store;
use Core\Settings\Notary\DefaultSetting;
use Core\Settings\Notary\DefaultSettingRepository;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    protected $repository;

    public function __construct(
        DefaultSettingRepository $defaultSettingRepository
    ) {
        $this->repository = $defaultSettingRepository;
    }
    public function index()
    {
        $defaultSettings = DefaultSetting::all();
        return view('settings.default', compact('defaultSettings'));
    }

    public function store(Store $request, $id)
    {
        $defaultSetting = DefaultSetting::query()->findOrFail($id);
        try {
            $this->repository->createDefaultSettings($defaultSetting, $request->input('notary_cost'));
            return redirect()->route('settings-index')->with('message', 'Сохранено!');
        }catch (\Throwable $err) {
            Log::error("Directories: update Notary-table error. " . $err->getMessage() . $err->getTraceAsString());
            return redirect()->back()->withErrors(['Ошибка сохранения']);
        }
    }
}
