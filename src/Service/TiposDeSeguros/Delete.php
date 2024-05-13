<?php

declare(strict_types=1);

namespace App\Service\TiposDeSeguros;

final class Delete extends Base
{
    public function delete(int $tipoDeSeguroId): void
    {
        $this->getOneFromDb($tipoDeSeguroId);
        $this->tiposDeSegurosRepository->deleteTipoDeSeguro($tipoDeSeguroId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($tipoDeSeguroId);
        }
    }
}
