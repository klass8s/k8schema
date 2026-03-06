<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ContainerState holds a possible state of container. Only one of its members may
 * be specified. If none of them is specified, the default one is
 * ContainerStateWaiting.
 */
class ContainerState implements JsonSerializable
{
    /**
     * Details about a running container
     */
    private ContainerStateRunning|null $running = null;

    /**
     * Details about a terminated container
     */
    private ContainerStateTerminated|null $terminated = null;

    /**
     * Details about a waiting container
     */
    private ContainerStateWaiting|null $waiting = null;

    public function __construct()
    {
    }

    public function getRunning(): ContainerStateRunning|null
    {
        return $this->running;
    }

    public function getTerminated(): ContainerStateTerminated|null
    {
        return $this->terminated;
    }

    public function getWaiting(): ContainerStateWaiting|null
    {
        return $this->waiting;
    }

    public function running(): ContainerStateRunning
    {
        return $this->running ??= new ContainerStateRunning();
    }

    public function setRunning(ContainerStateRunning $running): self
    {
        $this->running = $running;

        return $this;
    }

    public function setTerminated(ContainerStateTerminated $terminated): self
    {
        $this->terminated = $terminated;

        return $this;
    }

    public function setWaiting(ContainerStateWaiting $waiting): self
    {
        $this->waiting = $waiting;

        return $this;
    }

    public function waiting(): ContainerStateWaiting
    {
        return $this->waiting ??= new ContainerStateWaiting();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'running' => $this->running,
            'terminated' => $this->terminated,
            'waiting' => $this->waiting,
        ]);
    }
}
