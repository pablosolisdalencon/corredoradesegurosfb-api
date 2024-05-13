<?php

declare(strict_types=1);

namespace App\Service\Aliado;

use App\Entity\Aliado;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $aliadoId): object
    {
        $aliado = $this->getOneFromDb($aliadoId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $aliado->updateName(self::validateAliadoName($data->name));
        }
        if (isset($data->description)) {
            $aliado->updateDescription($data->description);
        }
        /** @var Aliado $aliados */
        $aliados = $this->aliadoRepository->updateAliado($aliado);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($aliados->getId(), $aliados->toJson());
        }

        return $aliados->toJson();
    }
}
