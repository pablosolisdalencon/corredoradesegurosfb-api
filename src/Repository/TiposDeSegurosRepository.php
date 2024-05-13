<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TiposDeSeguros;

final class TiposDeSegurosRepository extends BaseRepository
{
    public function checkAndGetTipoDeSeguro(int $tipoDeSeguroId): TiposDeSeguros
    {
        $query = 'SELECT * FROM `tiposdeseguros` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $tipoDeSeguroId);
        $statement->execute();
        $tipoDeSeguro = $statement->fetchObject(TiposDeSeguros::class);
        if (! $tipoDeSeguro) {
            throw new \App\Exception\TiposDeSeguros('Tipo de seguro not found.', 404);
        }

        return $tipoDeSeguro;
    }

    /**
     * @return array<string>
     */
    public function getTiposDeSeguros(): array
    {
        $query = 'SELECT * FROM `tiposdeseguros` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }
    public function getQueryTiposDeSegurosByPage(): string
    {
        return "
            SELECT *
            FROM `tiposdeseguros`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getTiposDeSegurosByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
        ];
        $query = $this->getQueryTiposDeSegurosByPage();
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $params['name']);
        $statement->bindParam('description', $params['description']);
        $statement->execute();
        $total = $statement->rowCount();

        return $this->getResultsWithPagination(
            $query,
            $page,
            $perPage,
            $params,
            $total
        );
    }

    public function createTipoDeSeguro(TiposDeSeguros $tipoDeSeguro): TiposDeSeguros
    {
        $query = '
            INSERT INTO `tiposdeseguros`
                (`name`, `description`, `aliado_id`)
            VALUES
                (:name, :description, :aliado_id)
        ';
        $statement = $this->database->prepare($query);
        $name = $tipoDeSeguro->getName();
        $desc = $tipoDeSeguro->getDescription();
        $aliadoId = $tipoDeSeguro->getAliadoId();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->bindParam(':aliado_id', $aliadoId);
        $statement->execute();

        return $this->checkAndGetTipoDeSeguro((int) $this->database->lastInsertId());
    }

    public function updateTipoDeSeguro(TiposDeSeguros $tipoDeSeguro): TiposDeSeguros
    {
        $query = '
            UPDATE `tiposdeseguros`
            SET `name` = :name, `description` = :description, `aliado_id` = :aliado_id
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $tipoDeSeguro->getId();
        $name = $tipoDeSeguro->getName();
        $desc = $tipoDeSeguro->getDescription();
        $aliadoId = $tipoDeSeguro->getAliadoId();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->bindParam(':aliado_id', $aliadoId);
        $statement->execute();

        return $this->checkAndGetTipoDeSeguro((int) $id);
    }

    public function deleteTipoDeSeguro(int $tipoDeSeguroId): void
    {
        $query = 'DELETE FROM `tiposdeseguros` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $tipoDeSeguroId);
        $statement->execute();
    }
}
