<?php

declare(strict_types=1);

namespace App\Entity;

final class Poliza
{
    private int $id;
    private string $name;
    private ?string $description;
    private int $tipodeseguro_id; // Enlace al tipo de seguro correspondiente (clave foránea)

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

    public function getTipoDeSeguroId(): int
    {
        return $this->tipodeseguro_id;
    }

    public function updateTipoDeSeguroId(int $tipoDeSeguroId): self
    {
        $this->tipodeseguro_id = $tipoDeSeguroId;
        return $this;
    }
}
