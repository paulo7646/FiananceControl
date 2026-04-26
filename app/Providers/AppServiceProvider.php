<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

use App\Models\Despesa;
use App\Models\Renda;

use App\Observers\DespesaObserver;
use App\Observers\RendaObserver;

use App\Models\Mes;
use App\Observers\MesObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::statement("PRAGMA journal_mode = WAL;");
        DB::statement("PRAGMA synchronous = NORMAL;");
        DB::statement("PRAGMA cache_size = 10000;");
        DB::statement("PRAGMA temp_store = MEMORY;");

        $this->configureDefaults();
        Despesa::observe(DespesaObserver::class);
        Renda::observe(RendaObserver::class);
        Mes::observe(MesObserver::class);
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
