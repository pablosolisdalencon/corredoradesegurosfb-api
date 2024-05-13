<?php

declare(strict_types=1);

namespace App\Service\Poliza;

use App\Entity\Poliza;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $polizaId): object
    {
        $poliza = $this->getOneFromDb($polizaId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $poliza->updateName(self::validatePolizaName($data->name));
        }
        if (isset($data->description)) {
            $poliza->updateDescription($data->description);
        }
        /** @var Poliza $polizas */
        $polizas = $this->polizaRepository->updatePoliza($poliza);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($polizas->getId(), $polizas->toJson());
        }

        return $polizas->toJson();
    }
}
