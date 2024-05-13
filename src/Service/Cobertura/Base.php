<?php

declare(strict_types=1);

namespace App\Service\Cobertura;

use App\Entity\Cobertura;
use App\Exception\Cobertura as CoberturaException;
use App\Repository\CoberturaRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'cobertura:%s';

    public function __construct(
        protected CoberturaRepository $coberturaRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validateCoberturaName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new CoberturaException('The name of the cobertura is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $coberturaId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $coberturaId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $cobertura = $this->redisService->get($key);
        } else {
            $cobertura = $this->getOneFromDb($coberturaId)->toJson();
            $this->redisService->setex($key, $cobertura);
        }

        return $cobertura;
    }

    protected function getOneFromDb(int $coberturaId): Cobertura
    {
        return $this->coberturaRepository->checkAndGetCobertura($coberturaId);
    }

    protected function saveInCache(int $id, object $cobertura): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $cobertura);
    }

    protected function deleteFromCache(int $coberturaId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $coberturaId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}
