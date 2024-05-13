<?php

declare(strict_types=1);

namespace App\Service\Seguro;

use App\Entity\Seguro;
use App\Exception\Seguro as SeguroException;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new SeguroException('Invalid data: name is required.', 400);
        }
        $mySeguro = new Seguro();
        $mySeguro->updateName(self::validateSeguroName($data->name));
        $description = $data->description ?? null;
        $mySeguro->updateDescription($description);
        /** @var Seguro $seguro */
        $seguro = $this->seguroRepository->createSeguro($mySeguro);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($seguro->getId(), $seguro->toJson());
        }

        return $seguro->toJson();
    }
}
