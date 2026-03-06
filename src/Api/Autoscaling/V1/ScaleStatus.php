<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ScaleStatus represents the current status of a scale subresource.
 */
class ScaleStatus implements JsonSerializable
{
    /**
     * replicas is the actual number of observed instances of the scaled object.
     */
    private int $replicas;

    /**
     * selector is the label query over pods that should match the replicas count. This
     * is same as the label selector but in the string format to avoid introspection by
     * clients. The string will be in the same format as the query-param syntax. More
     * info about label selectors:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/labels/
     */
    private string|null $selector = null;

    public function __construct(int $replicas)
    {
        $this->replicas = $replicas;
    }

    public function getReplicas(): int
    {
        return $this->replicas;
    }

    public function getSelector(): string|null
    {
        return $this->selector;
    }

    public function setReplicas(int $replicas): self
    {
        $this->replicas = $replicas;

        return $this;
    }

    public function setSelector(string $selector): self
    {
        $this->selector = $selector;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'replicas' => $this->replicas,
            'selector' => $this->selector,
        ]);
    }
}
