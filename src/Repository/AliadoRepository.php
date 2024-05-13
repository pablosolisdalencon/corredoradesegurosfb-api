<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Aliado;

final class AliadoRepository extends BaseRepository
{
    public function checkAndGetAliado(int $aliadoId): Aliado
    {
        $query = 'SELECT * FROM `aliados` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $aliadoId);
        $statement->execute();
        $aliado = $statement->fetchObject(Aliado::class);
        if (! $aliado) {
            throw new \App\Exception\Aliado('Aliado not found.', 404);
        }

        return $aliado;
    }

    /**
     * @return array<string>
     */
    public function getAliados(): array
    {
        $query = 'SELECT * FROM `aliados` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }
    public function getQueryAliadosByPage(): string
    {
        return "
            SELECT *
            FROM `aliados`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getAliadosByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
        ];
        $query = $this->getQueryAliadosByPage();
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

    public function createAliado(Aliado $aliado): Aliado
    {
        $query = '
            INSERT INTO `aliados`
                (`name`, `description`)
            VALUES
                (:name, :description)
        ';
        $statement = $this->database->prepare($query);
        $name = $aliado->getName();
        $desc = $aliado->getDescription();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetAliado((int) $this->database->lastInsertId());
    }

    public function updateAliado(Aliado $aliado): Aliado
    {
        $query = '
            UPDATE `aliados`
            SET `name` = :name, `description` = :description
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $aliado->getId();
        $name = $aliado->getName();
        $desc = $aliado->getDescription();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetAliado((int) $id);
    }

    public function deleteAliado(int $aliadoId): void
    {
        $query = 'DELETE FROM `aliados` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $aliadoId);
        $statement->execute();
    }
}
