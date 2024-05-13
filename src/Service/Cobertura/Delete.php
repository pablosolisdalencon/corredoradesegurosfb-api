<?php

declare(strict_types=1);

namespace App\Service\Cobertura;

final class Delete extends Base
{
    public function delete(int $coberturaId): void
    {
        $this->getOneFromDb($coberturaId);
        $this->coberturaRepository->deleteCobertura($coberturaId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($coberturaId);
        }
    }
}
