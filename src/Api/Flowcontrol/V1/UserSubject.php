<?php

declare(strict_types=1);

namespace K8Schema\Api\Flowcontrol\V1;

use ArrayObject;
use JsonSerializable;

/**
 * UserSubject holds detailed information for user-kind subject.
 */
class UserSubject implements JsonSerializable
{
    /**
     * `name` is the username that matches, or "*" to match all usernames. Required.
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
        ]);
    }
}
