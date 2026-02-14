<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * Affinity is a group of affinity scheduling rules.
 */
class Affinity implements JsonSerializable
{
    /**
     * Describes node affinity scheduling rules for the pod.
     */
    private NodeAffinity|null $nodeAffinity = null;

    /**
     * Describes pod affinity scheduling rules (e.g. co-locate this pod in the same
     * node, zone, etc. as some other pod(s)).
     */
    private PodAffinity|null $podAffinity = null;

    /**
     * Describes pod anti-affinity scheduling rules (e.g. avoid putting this pod in the
     * same node, zone, etc. as some other pod(s)).
     */
    private PodAntiAffinity|null $podAntiAffinity = null;

    public function __construct()
    {
    }

    public function nodeAffinity(): NodeAffinity
    {
        return $this->nodeAffinity ??= new NodeAffinity();
    }

    public function podAffinity(): PodAffinity
    {
        return $this->podAffinity ??= new PodAffinity();
    }

    public function podAntiAffinity(): PodAntiAffinity
    {
        return $this->podAntiAffinity ??= new PodAntiAffinity();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'nodeAffinity' => $this->nodeAffinity,
            'podAffinity' => $this->podAffinity,
            'podAntiAffinity' => $this->podAntiAffinity,
        ]);
    }
}
