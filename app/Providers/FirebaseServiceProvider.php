<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('firebase', function () {
            return (new Factory)
                    ->withServiceAccount(storage_path('app/SkillManagerFirebase.json'));
        });
    }
}
