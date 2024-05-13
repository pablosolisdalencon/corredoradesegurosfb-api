<?php

declare(strict_types=1);

namespace App\Service\Seguro;

final class Find extends Base
{
    /**
     * Obtiene todos los seguros.
     *
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->seguroRepository->getSeguros();
    }

    /**
     * Obtiene los seguros paginados según los filtros proporcionados.
     *
     * @param int         $page
     * @param int         $perPage
     * @param string|null $name
     * @param string|null $description
     *
     * @return array<string>
     */
    public function getSegurosByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        if ($page < 1) {
            $page = 1;
        }
        if ($perPage < 1) {
            $perPage = self::DEFAULT_PER_PAGE_PAGINATION;
        }

        return $this->seguroRepository->getSegurosByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    /**
     * Obtiene un seguro específico por su ID.
     *
     * @param int $seguroId
     *
     * @return object
     */
    public function getOne(int $seguroId): object
    {
        if (self::isRedisEnabled() === true) {
            $seguro = $this->getOneFromCache($seguroId);
        } else {
            $seguro = $this->getOneFromDb($seguroId)->toJson();
        }

        return $seguro;
    }
}
