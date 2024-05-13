<?php

declare(strict_types=1);

namespace App\Service\Seguro;

final class Delete extends Base
{
    public function delete(int $seguroId): void
    {
        $this->getOneFromDb($seguroId);
        $this->seguroRepository->deleteSeguro($seguroId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($seguroId);
        }
    }
}
