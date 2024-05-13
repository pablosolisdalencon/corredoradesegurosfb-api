<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Cobertura;

final class CoberturaRepository extends BaseRepository
{
    public function checkAndGetCobertura(int $coberturaId): Cobertura
    {
        $query = 'SELECT * FROM `coberturas` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $coberturaId);
        $statement->execute();
        $cobertura = $statement->fetchObject(Cobertura::class);
        if (! $cobertura) {
            throw new \App\Exception\Cobertura('Cobertura not found.', 404);
        }

        return $cobertura;
    }

    /**
     * @return array<string>
     */
    public function getCoberturas(): array
    {
        $query = 'SELECT * FROM `coberturas` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }
    public function getQueryCoberturasByPage(): string
    {
        return "
            SELECT *
            FROM `coberturas`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getCoberturasByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
        ];
        $query = $this->getQueryCoberturasByPage();
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

    public function createCobertura(Cobertura $cobertura): Cobertura
    {
        $query = '
            INSERT INTO `coberturas`
                (`name`, `description`, `seguro_id`)
            VALUES
                (:name, :description, :seguro_id)
        ';
        $statement = $this->database->prepare($query);
        $name = $cobertura->getName();
        $desc = $cobertura->getDescription();
        $seguroId = $cobertura->getSeguroId();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->bindParam(':seguro_id', $seguroId);
        $statement->execute();

        return $this->checkAndGetCobertura((int) $this->database->lastInsertId());
    }

    public function updateCobertura(Cobertura $cobertura): Cobertura
    {
        $query = '
            UPDATE `coberturas`
            SET `name` = :name, `description` = :description, `seguro_id` = :seguro_id
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $cobertura->getId();
        $name = $cobertura->getName();
        $desc = $cobertura->getDescription();
        $seguroId = $cobertura->getSeguroId();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->bindParam(':seguro_id', $seguroId);
        $statement->execute();

        return $this->checkAndGetCobertura((int) $id);
    }

    public function deleteCobertura(int $coberturaId): void
    {
        $query = 'DELETE FROM `coberturas` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $coberturaId);
        $statement->execute();
    }
}
