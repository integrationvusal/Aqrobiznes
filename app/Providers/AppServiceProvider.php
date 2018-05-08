<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Settings;
use App\Slider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   

		View::composer('*', function($view)
		{

            $slider = Slider::all();

			
			if(!isset($_SERVER['APP_URL'])) $_SERVER['APP_URL'] = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
			
            $img = $_SERVER['APP_URL'].'/upload/slider/'.$slider[0]['img'];

            if($view->offsetExists('img')){
                $img = $_SERVER['APP_URL'].'/upload/news/originals/'.$view->offsetGet('img');
            }
            elseif($view->offsetExists('content')){
                preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $view->offsetGet('content'), $matches);
                if(isset($matches['src']))    $img = $matches['src'];
            }


            $view->with('page_img', $img);
            $view->with('page_url', $_SERVER['APP_URL'].(isset($_SERVER['REDIRECT_URL'])?$_SERVER['REDIRECT_URL']:null));
            $view->with('settings', Settings::all());
            $view->with('slider', $slider);
            
		});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
