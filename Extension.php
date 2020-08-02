<?php namespace SamPoyigi\LocalePicker;

use System\Classes\BaseExtension;

/**
 * Locale Picker Extension Information File
 */
class Extension extends BaseExtension
{
    public function extensionMeta()
    {
        return [
            'code' => 'sampoyigi.localepicker',
            'name' => 'Locale Picker',
            'author' => 'SamPoyigi',
            'description' => 'Enables multi-lingual websites',
            'version' => '1.0.0',
            'icon' => 'fa fa-plug',
        ];
    }

    public function register()
    {
    }

    public function registerComponents()
    {
        return [
            'SamPoyigi\LocalePicker\Components\LocalePicker' => 'localePicker',
        ];
    }
}