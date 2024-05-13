<?php

declare(strict_types=1);

namespace App\Service\TiposDeSeguros;

use App\Entity\TiposDeSeguros;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $tipoDeSeguroId): object
    {
        $tipoDeSeguro = $this->getOneFromDb($tipoDeSeguroId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $tipoDeSeguro->updateName(self::validateTipoDeSeguroName($data->name));
        }
        if (isset($data->description)) {
            $tipoDeSeguro->updateDescription($data->description);
        }
        /** @var TiposDeSeguros $tiposDeSeguros */
        $tiposDeSeguros = $this->tiposDeSegurosRepository->updateTipoDeSeguro($tipoDeSeguro);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($tiposDeSeguros->getId(), $tiposDeSeguros->toJson());
        }

        return $tiposDeSeguros->toJson();
    }
}
