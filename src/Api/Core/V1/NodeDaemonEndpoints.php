<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NodeDaemonEndpoints lists ports opened by daemons running on the Node.
 */
class NodeDaemonEndpoints implements JsonSerializable
{
    /**
     * Endpoint on which Kubelet is listening.
     */
    private DaemonEndpoint|null $kubeletEndpoint = null;

    public function __construct()
    {
    }

    public function getKubeletEndpoint(): DaemonEndpoint|null
    {
        return $this->kubeletEndpoint;
    }

    public function setKubeletEndpoint(DaemonEndpoint $kubeletEndpoint): self
    {
        $this->kubeletEndpoint = $kubeletEndpoint;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'kubeletEndpoint' => $this->kubeletEndpoint,
        ]);
    }
}
