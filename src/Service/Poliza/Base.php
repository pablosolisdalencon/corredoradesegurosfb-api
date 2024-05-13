<?php

declare(strict_types=1);

namespace App\Service\Poliza;

use App\Entity\Poliza;
use App\Exception\Poliza as PolizaException;
use App\Repository\PolizaRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'poliza:%s';

    public function __construct(
        protected PolizaRepository $polizaRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validatePolizaName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new PolizaException('The name of the poliza is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $polizaId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $polizaId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $poliza = $this->redisService->get($key);
        } else {
            $poliza = $this->getOneFromDb($polizaId)->toJson();
            $this->redisService->setex($key, $poliza);
        }

        return $poliza;
    }

    protected function getOneFromDb(int $polizaId): Poliza
    {
        return $this->polizaRepository->checkAndGetPoliza($polizaId);
    }

    protected function saveInCache(int $id, object $poliza): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $poliza);
    }

    protected function deleteFromCache(int $polizaId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $polizaId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}
