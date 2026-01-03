<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
  public function register(): void {}

  public function boot(): void
  {
    Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

    if (app()->runningInConsole() === false && Schema::hasTable('settings')) {
      view()->share('settings', Setting::all()->pluck('value', 'key'));
    }
  }
}
