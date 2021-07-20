<?php

namespace Modules\Website\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use App\Section;
use App\ContactUs;
use App\City;
use App\Country;

class WebsiteServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Website';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'website';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        /*
         //echo \Config::get('app.locale');die;
        if(\Config::get('app.locale') == 'en'){
            $language_id = 1;
        }else{
            $language_id = 2;
        }

         $main_categories = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
            ->where('sections_description.language_id', $language_id)
            ->where('parent' , 0)->where('status', 1)
            ->orderBy('type')
            ->orderBy('sections_name')->get();
            //dd($main_categories);die;
        \View::share('main_categories', $main_categories);

        $all_categories = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
            ->where('sections_description.language_id', $language_id)
            ->where('status', 1)->where('type', '!=' , 2)->orderBy('name')->get();
        \View::share('all_categories', $all_categories);

        $contactusinfos = ContactUs::get();
        \View::share('contactusinfos', $contactusinfos);

        $allCountries = Country::where('status', 1)->get()->toArray();
        foreach ($allCountries as $value){
           $countries[$value['id']] = $value;
        }
        \View::share('countries', $countries);

        $allCitiesList = City::where('status', 1)->get()->toArray();
        foreach ($allCitiesList as $value){
           $allCities[$value['id']] = $value;
        }
        \View::share('allCities', $allCities);
        */
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path($this->moduleName, 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
