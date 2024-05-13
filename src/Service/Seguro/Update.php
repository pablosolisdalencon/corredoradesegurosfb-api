<?php

declare(strict_types=1);

namespace App\Service\Seguro;

use App\Entity\Seguro;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $seguroId): object
    {
        $seguro = $this->getOneFromDb($seguroId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $seguro->updateName(self::validateSeguroName($data->name));
        }
        if (isset($data->description)) {
            $seguro->updateDescription($data->description);
        }
        /** @var Seguro $seguros */
        $seguros = $this->seguroRepository->updateSeguro($seguro);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($seguros->getId(), $seguros->toJson());
        }

        return $seguros->toJson();
    }
}
