<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // $charts->register([
        //     \App\Charts\EarningChart::class
        // ]);

        \Illuminate\Support\Collection::macro('recursive', function () {
            return $this->whenNotEmpty($recursive = function ($item) use (&$recursive) {
                if (is_array($item)) {
                    return $recursive(new static($item));
                } elseif ($item instanceof \Illuminate\Support\Collection) {
                    $item->transform(static function ($collection, $key) use ($recursive, $item) {
                        return $item->{$key} = $recursive($collection);
                    });
                } elseif (is_object($item)) {
                    foreach ($item as $key => &$val) {
                        $item->{$key} = $recursive($val);
                    }
                }
                return $item;
            });
        });
    }
}
