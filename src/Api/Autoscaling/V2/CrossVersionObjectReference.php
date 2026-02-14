<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V2;

use ArrayObject;
use JsonSerializable;

/**
 * CrossVersionObjectReference contains enough information to let you identify the
 * referred resource.
 */
class CrossVersionObjectReference implements JsonSerializable
{
    /**
     * apiVersion is the API version of the referent
     */
    private string|null $apiVersion = null;

    /**
     * kind is the kind of the referent; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds
     */
    private string $kind;

    /**
     * name is the name of the referent; More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     */
    private string $name;

    public function __construct(string $kind, string $name)
    {
        $this->kind = $kind;
        $this->name = $name;
    }

    public function getApiVersion(): string|null
    {
        return $this->apiVersion;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function getName(): string
    {
        return $this->name;
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

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => $this->apiVersion,
            'kind' => $this->kind,
            'name' => $this->name,
        ]);
    }
}
