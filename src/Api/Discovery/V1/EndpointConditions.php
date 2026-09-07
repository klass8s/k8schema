<?php

declare(strict_types=1);

namespace K8Schema\Api\Discovery\V1;

use ArrayObject;
use JsonSerializable;

/**
 * EndpointConditions represents the current condition of an endpoint.
 */
class EndpointConditions implements JsonSerializable
{
    /**
     * ready indicates that this endpoint is ready to receive traffic, according to
     * whatever system is managing the endpoint. A nil value should be interpreted as
     * "true". In general, an endpoint should be marked ready if it is serving and not
     * terminating, though this can be overridden in some cases, such as when the
     * associated Service has set the publishNotReadyAddresses flag.
     */
    private bool|null $ready = null;

    /**
     * serving indicates that this endpoint is able to receive traffic, according to
     * whatever system is managing the endpoint. For endpoints backed by pods, the
     * EndpointSlice controller will mark the endpoint as serving if the pod's Ready
     * condition is True. A nil value should be interpreted as "true".
     */
    private bool|null $serving = null;

    /**
     * terminating indicates that this endpoint is terminating. A nil value should be
     * interpreted as "false".
     */
    private bool|null $terminating = null;

    public function __construct()
    {
    }

    public function getReady(): bool|null
    {
        return $this->ready;
    }

    public function getServing(): bool|null
    {
        return $this->serving;
    }

    public function getTerminating(): bool|null
    {
        return $this->terminating;
    }

    public function setReady(bool $ready): self
    {
        $this->ready = $ready;

        return $this;
    }

    public function setServing(bool $serving): self
    {
        $this->serving = $serving;

        return $this;
    }

    public function setTerminating(bool $terminating): self
    {
        $this->terminating = $terminating;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'ready' => $this->ready,
            'serving' => $this->serving,
            'terminating' => $this->terminating,
        ]);
    }
}
