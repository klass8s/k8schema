<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * ContainerStateRunning is a running state of a container.
 */
class ContainerStateRunning implements JsonSerializable
{
    /**
     * Time at which the container was last (re-)started
     */
    private DateTimeInterface|null $startedAt = null;

    public function __construct()
    {
    }

    public function getStartedAt(): DateTimeInterface|null
    {
        return $this->startedAt;
    }

    public function setStartedAt(DateTimeInterface $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'startedAt' => $this->startedAt,
        ]);
    }
}
