<?php

declare(strict_types=1);

namespace App\Service\Poliza;

final class Delete extends Base
{
    public function delete(int $polizaId): void
    {
        $this->getOneFromDb($polizaId);
        $this->polizaRepository->deletePoliza($polizaId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($polizaId);
        }
    }
}
