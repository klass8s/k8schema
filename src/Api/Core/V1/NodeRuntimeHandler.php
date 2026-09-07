<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NodeRuntimeHandler is a set of runtime handler information.
 */
class NodeRuntimeHandler implements JsonSerializable
{
    /**
     * Supported features.
     */
    private NodeRuntimeHandlerFeatures|null $features = null;

    /**
     * Runtime handler name. Empty for the default runtime handler.
     */
    private string|null $name = null;

    public function __construct()
    {
    }

    public function features(): NodeRuntimeHandlerFeatures
    {
        return $this->features ??= new NodeRuntimeHandlerFeatures();
    }

    public function getFeatures(): NodeRuntimeHandlerFeatures|null
    {
        return $this->features;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function setFeatures(NodeRuntimeHandlerFeatures $features): self
    {
        $this->features = $features;

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
            'features' => $this->features,
            'name' => $this->name,
        ]);
    }
}
