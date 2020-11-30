<?php

namespace App\Http\Controllers;
use App\Http\Requests\NotarySetting\Store;
use Core\Settings\Notary\DefaultSetting;
use Core\Settings\Notary\DefaultSettingRepository;

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
        $this->repository->createDefaultSettings($defaultSetting, $request->input('notary_cost'));
    }
}
