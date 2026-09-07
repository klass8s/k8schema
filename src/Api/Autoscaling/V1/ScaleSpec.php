<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ScaleSpec describes the attributes of a scale subresource.
 */
class ScaleSpec implements JsonSerializable
{
    /**
     * replicas is the desired number of instances for the scaled object.
     */
    private int|null $replicas = null;

    public function __construct()
    {
    }

    public function getReplicas(): int|null
    {
        return $this->replicas;
    }

    public function setReplicas(int $replicas): self
    {
        $this->replicas = $replicas;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'replicas' => $this->replicas,
        ]);
    }
}
