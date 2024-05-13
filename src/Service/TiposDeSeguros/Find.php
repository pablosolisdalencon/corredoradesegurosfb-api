<?php

declare(strict_types=1);

namespace App\Service\TiposDeSeguros;

final class Find extends Base
{
    /**
     * Obtiene todos los tipos de seguros.
     *
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->tiposDeSegurosRepository->getTiposDeSeguros();
    }

    /**
     * Obtiene los tipos de seguros paginados según los filtros proporcionados.
     *
     * @param int         $page
     * @param int         $perPage
     * @param string|null $name
     * @param string|null $description
     *
     * @return array<string>
     */
    public function getTiposDeSegurosByPage(
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

        return $this->tiposDeSegurosRepository->getTiposDeSegurosByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    /**
     * Obtiene un tipo de seguro específico por su ID.
     *
     * @param int $tipoDeSeguroId
     *
     * @return object
     */
    public function getOne(int $tipoDeSeguroId): object
    {
        if (self::isRedisEnabled() === true) {
            $tipoDeSeguro = $this->getOneFromCache($tipoDeSeguroId);
        } else {
            $tipoDeSeguro = $this->getOneFromDb($tipoDeSeguroId)->toJson();
        }

        return $tipoDeSeguro;
    }
}
