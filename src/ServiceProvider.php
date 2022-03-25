<?php
/**
 * Created by PhpStorm.
 * User: jtipsy
 * Date: 2022/3/25
 * Time: 18:59
 */

namespace Jtipsy\Cloudletter;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Netease::class, function(){
            return new Netease(config('services.netease.appKey'),config('services.netease.appSecret'),config('services.netease.appHost'),config('services.netease..appAuthorization'));
        });

        $this->app->alias(Netease::class,'netease');
    }

    public function provides()
    {
        return [Netease::class,'netease'];
    }

}