<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ServiceBackendPort is the service port being referenced.
 */
class ServiceBackendPort implements JsonSerializable
{
    /**
     * name is the name of the port on the Service. This is a mutually exclusive
     * setting with "Number".
     */
    private string|null $name = null;

    /**
     * number is the numerical port number (e.g. 80) on the Service. This is a mutually
     * exclusive setting with "Name".
     */
    private int|null $number = null;

    public function __construct()
    {
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getNumber(): int|null
    {
        return $this->number;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'number' => $this->number,
        ]);
    }
}
