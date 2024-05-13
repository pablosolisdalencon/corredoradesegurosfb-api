<?php

declare(strict_types=1);

namespace App\Service\Aliado;

final class Delete extends Base
{
    public function delete(int $aliadoId): void
    {
        $this->getOneFromDb($aliadoId);
        $this->aliadoRepository->deleteAliado($aliadoId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($aliadoId);
        }
    }
}
