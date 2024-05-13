<?php

declare(strict_types=1);

namespace App\Service\Poliza;

final class Find extends Base
{
    /**
     * Obtiene todas las pólizas.
     *
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->polizaRepository->getPolizas();
    }

    /**
     * Obtiene las pólizas paginadas según los filtros proporcionados.
     *
     * @param int         $page
     * @param int         $perPage
     * @param string|null $name
     * @param string|null $description
     *
     * @return array<string>
     */
    public function getPolizasByPage(
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

        return $this->polizaRepository->getPolizasByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    /**
     * Obtiene una póliza específica por su ID.
     *
     * @param int $polizaId
     *
     * @return object
     */
    public function getOne(int $polizaId): object
    {
        if (self::isRedisEnabled() === true) {
            $poliza = $this->getOneFromCache($polizaId);
        } else {
            $poliza = $this->getOneFromDb($polizaId)->toJson();
        }

        return $poliza;
    }
}
