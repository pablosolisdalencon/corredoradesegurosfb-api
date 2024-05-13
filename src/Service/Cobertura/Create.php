<?php

declare(strict_types=1);

namespace App\Service\Cobertura;

use App\Entity\Cobertura;
use App\Exception\Cobertura as CoberturaException;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new CoberturaException('Invalid data: name is required.', 400);
        }
        $myCobertura = new Cobertura();
        $myCobertura->updateName(self::validateCoberturaName($data->name));
        $description = $data->description ?? null;
        $myCobertura->updateDescription($description);
        /** @var Cobertura $cobertura */
        $cobertura = $this->coberturaRepository->createCobertura($myCobertura);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($cobertura->getId(), $cobertura->toJson());
        }

        return $cobertura->toJson();
    }
}
