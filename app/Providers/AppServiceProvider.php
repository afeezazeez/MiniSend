<?php

namespace App\Providers;

use App\Interfaces\IEmailService;
use App\Interfaces\IFileService;
use App\Services\EmailService;
use App\Services\FileService;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IFileService::class, FileService::class);
        $this->app->bind(IEmailService::class, EmailService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Str::macro('ScriptStripper', function ($string) {
            return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $string);
        });

    }
}
