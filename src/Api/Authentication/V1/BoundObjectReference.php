<?php

declare(strict_types=1);

namespace K8Schema\Api\Authentication\V1;

use ArrayObject;
use JsonSerializable;

/**
 * BoundObjectReference is a reference to an object that a token is bound to.
 */
class BoundObjectReference implements JsonSerializable
{
    /**
     * apiVersion is API version of the referent.
     */
    private string|null $apiVersion = null;

    /**
     * kind of the referent. Valid kinds are 'Pod' and 'Secret'.
     */
    private string|null $kind = null;

    /**
     * name of the referent.
     */
    private string|null $name = null;

    /**
     * uid of the referent.
     */
    private string|null $uid = null;

    public function __construct()
    {
    }

    public function getApiVersion(): string|null
    {
        return $this->apiVersion;
    }

    public function getKind(): string|null
    {
        return $this->kind;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getUid(): string|null
    {
        return $this->uid;
    }

    public function setApiVersion(string $apiVersion): self
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => $this->apiVersion,
            'kind' => $this->kind,
            'name' => $this->name,
            'uid' => $this->uid,
        ]);
    }
}
