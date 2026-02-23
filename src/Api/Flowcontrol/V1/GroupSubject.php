<?php

declare(strict_types=1);

namespace K8Schema\Api\Flowcontrol\V1;

use ArrayObject;
use JsonSerializable;

/**
 * GroupSubject holds detailed information for group-kind subject.
 */
class GroupSubject implements JsonSerializable
{
    /**
     * name is the user group that matches, or "*" to match all user groups. See
     * https://github.com/kubernetes/apiserver/blob/master/pkg/authentication/user/user.go
     * for some well-known group names. Required.
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
