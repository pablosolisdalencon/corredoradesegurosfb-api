<?php

declare(strict_types=1);

namespace App\Service\Aliado;

use App\Entity\Aliado;
use App\Exception\Aliado as AliadoException;
use App\Repository\AliadoRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'aliado:%s';

    public function __construct(
        protected AliadoRepository $aliadoRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validateAliadoName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new AliadoException('The name of the aliado is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $aliadoId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $aliadoId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $aliado = $this->redisService->get($key);
        } else {
            $aliado = $this->getOneFromDb($aliadoId)->toJson();
            $this->redisService->setex($key, $aliado);
        }

        return $aliado;
    }

    protected function getOneFromDb(int $aliadoId): Aliado
    {
        return $this->aliadoRepository->checkAndGetAliado($aliadoId);
    }

    protected function saveInCache(int $id, object $aliado): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $aliado);
    }

    protected function deleteFromCache(int $aliadoId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $aliadoId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}
