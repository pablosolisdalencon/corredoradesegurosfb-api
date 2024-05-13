<?php

declare(strict_types=1);

namespace App\Entity;

final class TiposDeSeguros
{
    private int $id;
    private string $name;
    private ?string $description;
    private int $aliado_id; // Enlace a la tabla de aliados (clave foránea)

    public function toJson(): object
    {
        return json_decode((string) json_encode(get_object_vars($this)), false);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function updateName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function updateDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getAliadoId(): int
    {
        return $this->aliado_id;
    }

    public function updateAliadoId(int $aliadoId): self
    {
        $this->aliado_id = $aliadoId;
        return $this;
    }
}
