<?php

declare(strict_types=1);



use App\Service\Empresa;
use App\Service\Aliado;
use App\Service\TiposDeSeguros;
use App\Service\Seguro;
use App\Service\Poliza;
use App\Service\Cobertura;

use App\Service\Note;
use App\Service\Task\TaskService;
use App\Service\User;
use Psr\Container\ContainerInterface;

$container['find_user_service'] = static fn (
    ContainerInterface $container
): User\Find => new User\Find(
    $container->get('user_repository'),
    $container->get('redis_service')
);

$container['create_user_service'] = static fn (
    ContainerInterface $container
): User\Create => new User\Create(
    $container->get('user_repository'),
    $container->get('redis_service')
);

$container['update_user_service'] = static fn (
    ContainerInterface $container
): User\Update => new User\Update(
    $container->get('user_repository'),
    $container->get('redis_service')
);

$container['delete_user_service'] = static fn (
    ContainerInterface $container
): User\Delete => new User\Delete(
    $container->get('user_repository'),
    $container->get('redis_service')
);

$container['login_user_service'] = static fn (
    ContainerInterface $container
): User\Login => new User\Login(
    $container->get('user_repository'),
    $container->get('redis_service')
);

$container['task_service'] = static fn (
    ContainerInterface $container
): TaskService => new TaskService(
    $container->get('task_repository'),
    $container->get('redis_service')
);

$container['find_note_service'] = static fn (
    ContainerInterface $container
): Note\Find => new Note\Find(
    $container->get('note_repository'),
    $container->get('redis_service')
);

$container['create_note_service'] = static fn (
    ContainerInterface $container
): Note\Create => new Note\Create(
    $container->get('note_repository'),
    $container->get('redis_service')
);

$container['update_note_service'] = static fn (
    ContainerInterface $container
): Note\Update => new Note\Update(
    $container->get('note_repository'),
    $container->get('redis_service')
);

$container['delete_note_service'] = static fn (
    ContainerInterface $container
): Note\Delete => new Note\Delete(
    $container->get('note_repository'),
    $container->get('redis_service')
);

$container['find_empresa_service'] = static fn (
    ContainerInterface $container
): Empresa\Find => new Empresa\Find(
    $container->get('empresa_repository'),
    $container->get('redis_service')
);

$container['create_empresa_service'] = static fn (
    ContainerInterface $container
): Empresa\Create => new Empresa\Create(
    $container->get('empresa_repository'),
    $container->get('redis_service')
);

$container['update_empresa_service'] = static fn (
    ContainerInterface $container
): Empresa\Update => new Empresa\Update(
    $container->get('empresa_repository'),
    $container->get('redis_service')
);

$container['delete_empresa_service'] = static fn (
    ContainerInterface $container
): Empresa\Delete => new Empresa\Delete(
    $container->get('empresa_repository'),
    $container->get('redis_service')
);
$container['find_aliado_service'] = static fn (
    ContainerInterface $container
): Aliado\Find => new Aliado\Find(
    $container->get('aliado_repository'),
    $container->get('redis_service')
);

$container['create_aliado_service'] = static fn (
    ContainerInterface $container
): Aliado\Create => new Aliado\Create(
    $container->get('aliado_repository'),
    $container->get('redis_service')
);

$container['update_aliado_service'] = static fn (
    ContainerInterface $container
): Aliado\Update => new Aliado\Update(
    $container->get('aliado_repository'),
    $container->get('redis_service')
);

$container['delete_aliado_service'] = static fn (
    ContainerInterface $container
): Aliado\Delete => new Aliado\Delete(
    $container->get('aliado_repository'),
    $container->get('redis_service')
);
$container['find_tipos_de_seguros_service'] = static fn (
    ContainerInterface $container
): TiposDeSeguros\Find => new TiposDeSeguros\Find(
    $container->get('tipos_de_seguros_repository'),
    $container->get('redis_service')
);

$container['create_tipos_de_seguros_service'] = static fn (
    ContainerInterface $container
): TiposDeSeguros\Create => new TiposDeSeguros\Create(
    $container->get('tipos_de_seguros_repository'),
    $container->get('redis_service')
);

$container['update_tipos_de_seguros_service'] = static fn (
    ContainerInterface $container
): TiposDeSeguros\Update => new TiposDeSeguros\Update(
    $container->get('tipos_de_seguros_repository'),
    $container->get('redis_service')
);

$container['delete_tipos_de_seguros_service'] = static fn (
    ContainerInterface $container
): TiposDeSeguros\Delete => new TiposDeSeguros\Delete(
    $container->get('tipos_de_seguros_repository'),
    $container->get('redis_service')
);
$container['find_seguro_service'] = static fn (
    ContainerInterface $container
): Seguro\Find => new Seguro\Find(
    $container->get('seguro_repository'),
    $container->get('redis_service')
);

$container['create_seguro_service'] = static fn (
    ContainerInterface $container
): Seguro\Create => new Seguro\Create(
    $container->get('seguro_repository'),
    $container->get('redis_service')
);

$container['update_seguro_service'] = static fn (
    ContainerInterface $container
): Seguro\Update => new Seguro\Update(
    $container->get('seguro_repository'),
    $container->get('redis_service')
);

$container['delete_seguro_service'] = static fn (
    ContainerInterface $container
): Seguro\Delete => new Seguro\Delete(
    $container->get('seguro_repository'),
    $container->get('redis_service')
);
$container['find_poliza_service'] = static fn (
    ContainerInterface $container
): Poliza\Find => new Poliza\Find(
    $container->get('poliza_repository'),
    $container->get('redis_service')
);

$container['create_poliza_service'] = static fn (
    ContainerInterface $container
): Poliza\Create => new Poliza\Create(
    $container->get('poliza_repository'),
    $container->get('redis_service')
);

$container['update_poliza_service'] = static fn (
    ContainerInterface $container
): Poliza\Update => new Poliza\Update(
    $container->get('poliza_repository'),
    $container->get('redis_service')
);

$container['delete_poliza_service'] = static fn (
    ContainerInterface $container
): Poliza\Delete => new Poliza\Delete(
    $container->get('poliza_repository'),
    $container->get('redis_service')
);


$container['find_cobertura_service'] = static fn (
    ContainerInterface $container
): Cobertura\Find => new Cobertura\Find(
    $container->get('cobertura_repository'),
    $container->get('redis_service')
);

$container['create_cobertura_service'] = static fn (
    ContainerInterface $container
): Cobertura\Create => new Cobertura\Create(
    $container->get('cobertura_repository'),
    $container->get('redis_service')
);

$container['update_cobertura_service'] = static fn (
    ContainerInterface $container
): Cobertura\Update => new Cobertura\Update(
    $container->get('cobertura_repository'),
    $container->get('redis_service')
);

$container['delete_cobertura_service'] = static fn (
    ContainerInterface $container
): Cobertura\Delete => new Cobertura\Delete(
    $container->get('cobertura_repository'),
    $container->get('redis_service')
);