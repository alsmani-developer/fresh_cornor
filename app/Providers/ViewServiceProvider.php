<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\CattlesType;
use App\CattlesOrigin;
use App\MeatsArea;
use App\MeatsShape;
use Cart;
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['site.inc.nav', 'site.inc.header', 'site.inc.footer', 'site.home.category'], function($view){
            $CattlesType = CattlesType::get();
            $view->with('CattlesType', $CattlesType);
        });
        view()->composer(['*'], function($view){
            if (session()->has('locale')) {
                App::setLocale(session()->get('locale'));
            }else{
                App::setLocale('ar');
            }
            $locale = session()->get('locale'); 
            if (empty($locale)) {
                $locale = 'ar';
            }else{
                $locale = session()->get('locale');    
            }
            $view->with('locale', $locale);
        });
        view()->composer('site.inc.header', function ($view) {
            $CattlesOrigins = CattlesOrigin::get();
            $MeatsAreas = MeatsArea::get();
            $MeatsShapes = MeatsShape::get();
            $data = ['cartCount' => Cart::getContent()->count(), 'CattlesOrigins' => $CattlesOrigins,
            'MeatsAreas' => $MeatsAreas, 'MeatsShapes' => $MeatsShapes];
            $view->with($data);
        });
    }
}
