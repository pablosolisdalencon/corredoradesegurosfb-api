<?php

declare(strict_types=1);

use App\Repository\EmpresaRepository;
use App\Repository\AliadoRepository;
use App\Repository\TiposDeSegurosRepository;
use App\Repository\SeguroRepository;
use App\Repository\PolizaRepository;
use App\Repository\CoberturaRepository;
use App\Repository\NoteRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Psr\Container\ContainerInterface;

$container['user_repository'] = static fn (
    ContainerInterface $container
): UserRepository => new UserRepository($container->get('db'));

$container['task_repository'] = static fn (
    ContainerInterface $container
): TaskRepository => new TaskRepository($container->get('db'));

$container['note_repository'] = static fn (
    ContainerInterface $container
): NoteRepository => new NoteRepository($container->get('db'));

$container['empresa_repository'] = static fn (
    ContainerInterface $container
): EmpresaRepository => new EmpresaRepository($container->get('db'));
$container['aliado_repository'] = static fn (
    ContainerInterface $container
): AliadoRepository => new AliadoRepository($container->get('db'));

$container['tipos_de_seguros_repository'] = static fn (
    ContainerInterface $container
): TiposDeSegurosRepository => new TiposDeSegurosRepository($container->get('db'));

$container['seguro_repository'] = static fn (
    ContainerInterface $container
): SeguroRepository => new SeguroRepository($container->get('db'));

$container['poliza_repository'] = static fn (
    ContainerInterface $container
): PolizaRepository => new PolizaRepository($container->get('db'));

$container['cobertura_repository'] = static fn (
    ContainerInterface $container
): CoberturaRepository => new CoberturaRepository($container->get('db'));
