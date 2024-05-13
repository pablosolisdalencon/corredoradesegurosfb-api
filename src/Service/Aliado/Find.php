<?php

declare(strict_types=1);

namespace App\Service\Aliado;

final class Find extends Base
{
    /**
     * Obtiene todos los aliados.
     *
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->aliadoRepository->getAliados();
    }

    /**
     * Obtiene los aliados paginados según los filtros proporcionados.
     *
     * @param int         $page
     * @param int         $perPage
     * @param string|null $name
     * @param string|null $description
     *
     * @return array<string>
     */
    public function getAliadosByPage(
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

        return $this->aliadoRepository->getAliadosByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    /**
     * Obtiene un aliado específico por su ID.
     *
     * @param int $aliadoId
     *
     * @return object
     */
    public function getOne(int $aliadoId): object
    {
        if (self::isRedisEnabled() === true) {
            $aliado = $this->getOneFromCache($aliadoId);
        } else {
            $aliado = $this->getOneFromDb($aliadoId)->toJson();
        }

        return $aliado;
    }
}
