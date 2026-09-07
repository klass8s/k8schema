<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NodeConfigSource specifies a source of node configuration. Exactly one subfield
 * (excluding metadata) must be non-nil. This API is deprecated since 1.22
 */
class NodeConfigSource implements JsonSerializable
{
    /**
     * ConfigMap is a reference to a Node's ConfigMap
     */
    private ConfigMapNodeConfigSource|null $configMap = null;

    public function __construct()
    {
    }

    public function getConfigMap(): ConfigMapNodeConfigSource|null
    {
        return $this->configMap;
    }

    public function setConfigMap(ConfigMapNodeConfigSource $configMap): self
    {
        $this->configMap = $configMap;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'configMap' => $this->configMap,
        ]);
    }
}
