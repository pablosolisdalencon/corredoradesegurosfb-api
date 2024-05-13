<?php

declare(strict_types=1);

namespace App\Service\TiposDeSeguros;

use App\Entity\TiposDeSeguros;
use App\Exception\TiposDeSeguros as TiposDeSegurosException;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new TiposDeSegurosException('Invalid data: name is required.', 400);
        }
        $myTipoDeSeguro = new TiposDeSeguros();
        $myTipoDeSeguro->updateName(self::validateTipoDeSeguroName($data->name));
        $description = $data->description ?? null;
        $myTipoDeSeguro->updateDescription($description);
        /** @var TiposDeSeguros $tipoDeSeguro */
        $tipoDeSeguro = $this->tiposDeSegurosRepository->createTipoDeSeguro($myTipoDeSeguro);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($tipoDeSeguro->getId(), $tipoDeSeguro->toJson());
        }

        return $tipoDeSeguro->toJson();
    }
}
