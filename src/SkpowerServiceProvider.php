<?php
namespace skypower\laraveltest;
use Illuminate\Support\ServiceProvider;

class SkpowerServiceProvider extends ServiceProvider
{
    protected $defer = true; //延迟加载服务

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //单例绑定服务
        $this->app->singleton('laraveltest',function($app) {
            //传递配置项容器,可以在初始化的时候,获取config目录下的任何一个配置文件以及配置项
            return new Laraveltest($app['config']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //此处可以用来发布包所需要的静态资源或者包所依赖的路由
        $this->loadViewsFrom(__DIR__ . '/views', 'Laraveltest'); //视图目录指定
        $this->publishes([
            //在这里指定绑定关系, key = 包里面的视图目录路径  value = 安装包的时候,需要把这份资源发布复制到laravel的视图目录路径
            __DIR__ . '/views' => base_path('resource/views/laraveltest'), //发布视图目录到resource下
            //也可以指定发布某一个文件,上面的是把整个目录下的文件都整体平移过去
            __DIR__ . '/config/laraveltest.php' => config_path('laraveltest.php'), //发布视图目录到resource下
        ]);
    }

    public function provides()
    {
        //因为是延迟加载,需要定义provides方法
        return ['laraveltest'];
    }
}
