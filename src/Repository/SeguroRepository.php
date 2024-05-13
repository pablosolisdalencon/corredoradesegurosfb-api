<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Seguro;

final class SeguroRepository extends BaseRepository
{
    public function checkAndGetSeguro(int $seguroId): Seguro
    {
        $query = 'SELECT * FROM `seguros` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $seguroId);
        $statement->execute();
        $seguro = $statement->fetchObject(Seguro::class);
        if (! $seguro) {
            throw new \App\Exception\Seguro('Seguro not found.', 404);
        }

        return $seguro;
    }

    /**
     * @return array<string>
     */
    public function getSeguros(): array
    {
        $query = 'SELECT * FROM `seguros` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }
    public function getQuerySegurosByPage(): string
    {
        return "
            SELECT *
            FROM `seguros`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getSegurosByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
        ];
        $query = $this->getQuerySegurosByPage();
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

    public function createSeguro(Seguro $seguro): Seguro
    {
        $query = '
            INSERT INTO `seguros`
                (`name`, `description`, `tipodeseguro_id`)
            VALUES
                (:name, :description, :tipodeseguro_id)
        ';
        $statement = $this->database->prepare($query);
        $name = $seguro->getName();
        $desc = $seguro->getDescription();
        $tipoDeSeguroId = $seguro->getTipoDeSeguroId();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->bindParam(':tipodeseguro_id', $tipoDeSeguroId);
        $statement->execute();

        return $this->checkAndGetSeguro((int) $this->database->lastInsertId());
    }

    public function updateSeguro(Seguro $seguro): Seguro
    {
        $query = '
            UPDATE `seguros`
            SET `name` = :name, `description` = :description, `tipodeseguro_id` = :tipodeseguro_id
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $seguro->getId();
        $name = $seguro->getName();
        $desc = $seguro->getDescription();
        $tipoDeSeguroId = $seguro->getTipoDeSeguroId();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->bindParam(':tipodeseguro_id', $tipoDeSeguroId);
        $statement->execute();

        return $this->checkAndGetSeguro((int) $id);
    }

    public function deleteSeguro(int $seguroId): void
    {
        $query = 'DELETE FROM `seguros` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $seguroId);
        $statement->execute();
    }
}
