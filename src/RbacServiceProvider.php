<?php

namespace Ybinrain\Rbac;

use Illuminate\Support\ServiceProvider;
use Blade;

class RbacServiceProvider extends ServiceProvider 
{
    public function register()
    {
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/database/migrations/' => base_path('/database/migrations')
        ]);
        Blade::directive('ifUserIs', function($expression) {
            return "<?php if(Auth::check() && Auth::user()->hasRole{$expression}): ?>";
        });
        Blade::directive('ifUserCan', function($expression){
            return "<?php if(Auth::check() && Auth::user()->canDo{$expression}): ?>";
        });
    }
}
