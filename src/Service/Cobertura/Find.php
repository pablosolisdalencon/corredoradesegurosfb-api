<?php

declare(strict_types=1);

namespace App\Service\Cobertura;

final class Find extends Base
{
    /**
     * Obtiene todas las coberturas.
     *
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->coberturaRepository->getCoberturas();
    }

    /**
     * Obtiene las coberturas paginadas según los filtros proporcionados.
     *
     * @param int         $page
     * @param int         $perPage
     * @param string|null $name
     * @param string|null $description
     *
     * @return array<string>
     */
    public function getCoberturasByPage(
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

        return $this->coberturaRepository->getCoberturasByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    /**
     * Obtiene una cobertura específica por su ID.
     *
     * @param int $coberturaId
     *
     * @return object
     */
    public function getOne(int $coberturaId): object
    {
        if (self::isRedisEnabled() === true) {
            $cobertura = $this->getOneFromCache($coberturaId);
        } else {
            $cobertura = $this->getOneFromDb($coberturaId)->toJson();
        }

        return $cobertura;
    }
}
