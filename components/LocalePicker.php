<?php namespace SamPoyigi\LocalePicker\Components;

use Redirect;
use Request;
use System\Classes\BaseComponent;
use System\Models\Languages_model;

class LocalePicker extends BaseComponent
{
    /**
     * @var \Igniter\Flame\Translation\Localization Translator object.
     */
    protected $localization;

    /**
     * @var array Collection of supported locales.
     */
    public $locales;

    /**
     * @var string The active locale code.
     */
    public $activeLocale;

    /**
     * @var string The active locale name.
     */
    public $activeLocaleName;

    /**
     * @var string The active locale code before switching.
     */
    public $oldLocale;

    public function componentDetails()
    {
        return [
            'name' => 'Locale Picker',
            'description' => 'Shows a dropdown to select a front-end language.',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function initialize()
    {
        $this->localization = app('translator.localization');
    }

    public function onRun()
    {
        if ($redirect = $this->redirectForceUrl()) {
            return $redirect;
        }

        $this->locales = Languages_model::listSupported();
        $this->activeLocale = $this->localization->getLocale();
        $this->activeLocaleName = array_get($this->locales, $this->activeLocale);
    }

    public function onSwitchLocale()
    {
        if (!$locale = post('locale')) {
            return;
        }

        $this->oldLocale = $this->localization->getLocale();

        $this->localization->setLocale($locale);

        return Redirect::to($this->controller->currentPageUrl());
    }

    protected function redirectForceUrl()
    {
        if (Request::ajax() OR $this->localization->loadLocaleFromRequest()) {
            return;
        }
    }
}