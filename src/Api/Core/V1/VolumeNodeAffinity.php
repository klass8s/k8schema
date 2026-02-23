<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * VolumeNodeAffinity defines constraints that limit what nodes this volume can be
 * accessed from.
 */
class VolumeNodeAffinity implements JsonSerializable
{
    /**
     * required specifies hard node constraints that must be met.
     */
    private NodeSelector|null $required = null;

    public function __construct()
    {
    }

    public function getRequired(): NodeSelector|null
    {
        return $this->required;
    }

    public function required(): NodeSelector
    {
        return $this->required ??= new NodeSelector();
    }

    public function setRequired(NodeSelector $required): self
    {
        $this->required = $required;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'required' => $this->required,
        ]);
    }
}
