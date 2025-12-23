<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Propiedades;
use App\Modules\Bsc\Models\subprocess;

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
    public function boot()
    {
        //esto es para la vista de BSC(Balanced Score Card)
        // Definir una política de autorización para el usuario con nombre 'Administrador 1'
        // Este ajuste a la logica permite que solo el usuario con el nombre designado es el unico o unicos que podran tener acceso a la agregacion de mas procesos
         Gate::before(function (User $user) {
            if ($user->name === 'Administrador 1') {
                return true;
            }
        });



        View::composer('*', function ($view) {
            $user = Auth::user();
            $privilegios = $user ? $user->privilegios : null; // Carga privilegios si el usuario está autenticado
            $view->with('privilegios', $privilegios);
        });
    }
}
