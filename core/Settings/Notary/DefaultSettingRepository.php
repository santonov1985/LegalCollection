<?php
namespace Core\Settings\Notary;

class DefaultSettingRepository
{
    public function createDefaultSettings(
        DefaultSetting $defaultSetting,
        float $notary_cost
    ):DefaultSetting

    {
        $defaultSetting->notary_cost = $notary_cost;
        $defaultSetting->saveOrFail();

        return $defaultSetting;
    }
}
