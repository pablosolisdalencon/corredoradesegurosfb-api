<?php

declare(strict_types=1);

namespace App\Service\Aliado;

use App\Entity\Aliado;
use App\Exception\Aliado as AliadoException;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new AliadoException('Invalid data: name is required.', 400);
        }
        $myAliado = new Aliado();
        $myAliado->updateName(self::validateAliadoName($data->name));
        $description = $data->description ?? null;
        $myAliado->updateDescription($description);
        /** @var Aliado $aliado */
        $aliado = $this->aliadoRepository->createAliado($myAliado);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($aliado->getId(), $aliado->toJson());
        }

        return $aliado->toJson();
    }
}
