<?php

namespace Autenticacao\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Autenticacao\Model' => 'Autenticacao\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
		
		Passport::tokensExpireIn(now()->addDays(15));
		Passport::refreshTokensExpireIn(now()->addDays(30));
		
		Passport::enableImplicitGrant();
		
		Passport::tokensCan([
			'produto-consultar' => 'Consulta de Produtos',
			'produto-incluir' => 'Inclusão de Produtos',
		]);
    }
}
