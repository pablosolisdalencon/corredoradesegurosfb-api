<?php

declare(strict_types=1);

use App\Controller\Empresa;
use App\Controller\Aliado;
use App\Controller\TiposDeSeguros;
use App\Controller\Seguro;
use App\Controller\Poliza;
use App\Controller\Cobertura;
use App\Controller\Note;
use App\Controller\Task;
use App\Controller\User;
use App\Middleware\Auth;

return static function ($app) {
    $app->get('/', 'App\Controller\DefaultController:getHelp');
    $app->get('/status', 'App\Controller\DefaultController:getStatus');
    $app->post('/login', \App\Controller\User\Login::class);

    $app->group('/api/v1', function () use ($app): void {
        $app->group('/tasks', function () use ($app): void {
            $app->get('', Task\GetAll::class);
            $app->post('', Task\Create::class);
            $app->get('/{id}', Task\GetOne::class);
            $app->put('/{id}', Task\Update::class);
            $app->delete('/{id}', Task\Delete::class);
        })->add(new Auth());

        $app->group('/users', function () use ($app): void {
            $app->get('', User\GetAll::class)->add(new Auth());
            $app->post('', User\Create::class);
            $app->get('/{id}', User\GetOne::class)->add(new Auth());
            $app->put('/{id}', User\Update::class)->add(new Auth());
            $app->delete('/{id}', User\Delete::class)->add(new Auth());
        });

        $app->group('/notes', function () use ($app): void {
            $app->get('', Note\GetAll::class);
            $app->post('', Note\Create::class);
            $app->get('/{id}', Note\GetOne::class);
            $app->put('/{id}', Note\Update::class);
            $app->delete('/{id}', Note\Delete::class);
        });
        
        $app->group('/empresas', function () use ($app): void {
            $app->get('', Empresa\GetAll::class);
            $app->post('', Empresa\Create::class);
            $app->get('/{id}', Empresa\GetOne::class);
            $app->put('/{id}', Empresa\Update::class);
            $app->delete('/{id}', Empresa\Delete::class);
        });
        $app->group('/aliados', function () use ($app): void {
            $app->get('', Aliado\GetAll::class);
            $app->post('', Aliado\Create::class);
            $app->get('/{id}', Aliado\GetOne::class);
            $app->put('/{id}', Aliado\Update::class);
            $app->delete('/{id}', Aliado\Delete::class);
        });
        
        $app->group('/tipos-de-seguros', function () use ($app): void {
            $app->get('', TiposDeSeguros\GetAll::class);
            $app->post('', TiposDeSeguros\Create::class);
            $app->get('/{id}', TiposDeSeguros\GetOne::class);
            $app->put('/{id}', TiposDeSeguros\Update::class);
            $app->delete('/{id}', TiposDeSeguros\Delete::class);
        });
        
        $app->group('/seguros', function () use ($app): void {
            $app->get('', Seguro\GetAll::class);
            $app->post('', Seguro\Create::class);
            $app->get('/{id}', Seguro\GetOne::class);
            $app->put('/{id}', Seguro\Update::class);
            $app->delete('/{id}', Seguro\Delete::class);
        });
        
        $app->group('/polizas', function () use ($app): void {
            $app->get('', Poliza\GetAll::class);
            $app->post('', Poliza\Create::class);
            $app->get('/{id}', Poliza\GetOne::class);
            $app->put('/{id}', Poliza\Update::class);
            $app->delete('/{id}', Poliza\Delete::class);
        });
        
        $app->group('/coberturas', function () use ($app): void {
            $app->get('', Cobertura\GetAll::class);
            $app->post('', Cobertura\Create::class);
            $app->get('/{id}', Cobertura\GetOne::class);
            $app->put('/{id}', Cobertura\Update::class);
            $app->delete('/{id}', Cobertura\Delete::class);
        });
        

    });

    return $app;
};
