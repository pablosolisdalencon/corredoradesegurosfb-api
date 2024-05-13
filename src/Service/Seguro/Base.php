<?php

declare(strict_types=1);

namespace App\Service\Seguro;

use App\Entity\Seguro;
use App\Exception\Seguro as SeguroException;
use App\Repository\SeguroRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'seguro:%s';

    public function __construct(
        protected SeguroRepository $seguroRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validateSeguroName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new SeguroException('The name of the seguro is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $seguroId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $seguroId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $seguro = $this->redisService->get($key);
        } else {
            $seguro = $this->getOneFromDb($seguroId)->toJson();
            $this->redisService->setex($key, $seguro);
        }

        return $seguro;
    }

    protected function getOneFromDb(int $seguroId): Seguro
    {
        return $this->seguroRepository->checkAndGetSeguro($seguroId);
    }

    protected function saveInCache(int $id, object $seguro): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $seguro);
    }

    protected function deleteFromCache(int $seguroId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $seguroId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}
