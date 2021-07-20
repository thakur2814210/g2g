<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use DB;
use App\Section;
use App\ContactUs;
use App\City;
use App\Country;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if(file_exists(storage_path('installed'))){
            $result = array();
            $orders = DB::table('orders')
            ->leftJoin('customers','customers.customers_id','=','orders.customers_id')
            ->where('orders.is_seen','=', 0)
            ->orderBy('orders_id','desc')
            ->get();

            $index = 0;
            foreach($orders as $orders_data){

              array_push($result,$orders_data);
              $orders_products = DB::table('orders_products')
                ->where('orders_id', '=' ,$orders_data->orders_id)
                ->get();

              $result[$index]->price = $orders_products;
              $result[$index]->total_products = count($orders_products);
              $index++;
            }

            //new customers
            $newCustomers = DB::table('users')
                ->where('is_seen','=', 0)
                ->orderBy('id','desc')
                ->get();

            //products low in quantity
            $lowInQunatity = DB::table('products')
              ->LeftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
              ->whereColumn('products.products_quantity', '<=', 'products.low_limit')
              ->where('products_description.language_id', '=', '1')
              ->where('products.low_limit', '>', 0)
              //->get();
              ->paginate(10);

            $languages = DB::table('languages')->get();
            view()->share('languages', $languages);
            $images = '';
            $web_setting = DB::table('settings')->get();
            view()->share('web_setting', $web_setting);
            view()->share('images', $images);
            view()->share('unseenOrders', $result);
            view()->share('newCustomers', $newCustomers);
            view()->share('lowInQunatity', $lowInQunatity);

              //echo \Config::get('app.locale');die;
        if(\Config::get('app.locale') == 'en'){
            $language_id = 1;
        }else{
            $language_id = 2;
        }

            /*$main_categories = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
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
            \View::share('allCities', $allCities);*/
        }
    }
}
