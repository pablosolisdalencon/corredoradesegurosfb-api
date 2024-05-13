<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Poliza;

final class PolizaRepository extends BaseRepository
{
    public function checkAndGetPoliza(int $polizaId): Poliza
    {
        $query = 'SELECT * FROM `polizas` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $polizaId);
        $statement->execute();
        $poliza = $statement->fetchObject(Poliza::class);
        if (! $poliza) {
            throw new \App\Exception\Poliza('Poliza not found.', 404);
        }

        return $poliza;
    }

    /**
     * @return array<string>
     */
    public function getPolizas(): array
    {
        $query = 'SELECT * FROM `polizas` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }
    public function getQueryPolizasByPage(): string
    {
        return "
            SELECT *
            FROM `polizas`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getPolizasByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
        ];
        $query = $this->getQueryPolizasByPage();
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

    public function createPoliza(Poliza $poliza): Poliza
    {
        $query = '
            INSERT INTO `polizas`
                (`name`, `description`, `tipodeseguro_id`)
            VALUES
                (:name, :description, :tipodeseguro_id)
        ';
        $statement = $this->database->prepare($query);
        $name = $poliza->getName();
        $desc = $poliza->getDescription();
        $tipoDeSeguroId = $poliza->getTipoDeSeguroId();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->bindParam(':tipodeseguro_id', $tipoDeSeguroId);
        $statement->execute();

        return $this->checkAndGetPoliza((int) $this->database->lastInsertId());
    }

    public function updatePoliza(Poliza $poliza): Poliza
    {
        $query = '
            UPDATE `polizas`
            SET `name` = :name, `description` = :description, `tipodeseguro_id` = :tipodeseguro_id
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $poliza->getId();
        $name = $poliza->getName();
        $desc = $poliza->getDescription();
        $tipoDeSeguroId = $poliza->getTipoDeSeguroId();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->bindParam(':tipodeseguro_id', $tipoDeSeguroId);
        $statement->execute();

        return $this->checkAndGetPoliza((int) $id);
    }

    public function deletePoliza(int $polizaId): void
    {
        $query = 'DELETE FROM `polizas` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $polizaId);
        $statement->execute();
    }
}
