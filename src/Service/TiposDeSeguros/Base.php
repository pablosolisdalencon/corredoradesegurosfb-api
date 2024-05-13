<?php

declare(strict_types=1);

namespace App\Service\TiposDeSeguros;

use App\Entity\TiposDeSeguros;
use App\Exception\TiposDeSeguros as TiposDeSegurosException;
use App\Repository\TiposDeSegurosRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'tiposdeseguros:%s';

    public function __construct(
        protected TiposDeSegurosRepository $tiposDeSegurosRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validateTipoDeSeguroName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new TiposDeSegurosException('The name of the tipo de seguro is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $tipoDeSeguroId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $tipoDeSeguroId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $tipoDeSeguro = $this->redisService->get($key);
        } else {
            $tipoDeSeguro = $this->getOneFromDb($tipoDeSeguroId)->toJson();
            $this->redisService->setex($key, $tipoDeSeguro);
        }

        return $tipoDeSeguro;
    }

    protected function getOneFromDb(int $tipoDeSeguroId): TiposDeSeguros
    {
        return $this->tiposDeSegurosRepository->checkAndGetTipoDeSeguro($tipoDeSeguroId);
    }

    protected function saveInCache(int $id, object $tipoDeSeguro): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $tipoDeSeguro);
    }

    protected function deleteFromCache(int $tipoDeSeguroId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $tipoDeSeguroId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}
