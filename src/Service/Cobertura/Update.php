<?php

declare(strict_types=1);

namespace App\Service\Cobertura;

use App\Entity\Cobertura;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $coberturaId): object
    {
        $cobertura = $this->getOneFromDb($coberturaId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $cobertura->updateName(self::validateCoberturaName($data->name));
        }
        if (isset($data->description)) {
            $cobertura->updateDescription($data->description);
        }
        /** @var Cobertura $coberturas */
        $coberturas = $this->coberturaRepository->updateCobertura($cobertura);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($coberturas->getId(), $coberturas->toJson());
        }

        return $coberturas->toJson();
    }
}
