<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use JsonSerializable;

/**
 * ContainerResizePolicy represents resource resize policy for the container.
 */
class ContainerResizePolicy implements JsonSerializable
{
    /**
     * Name of the resource to which this resource resize policy applies. Supported
     * values: cpu, memory.
     */
    private string $resourceName;

    /**
     * Restart policy to apply when specified resource is resized. If not specified, it
     * defaults to NotRequired.
     */
    private string $restartPolicy;

    public function __construct(string $resourceName, string $restartPolicy)
    {
        $this->resourceName = $resourceName;
        $this->restartPolicy = $restartPolicy;
    }

    public function getResourceName(): string
    {
        return $this->resourceName;
    }

    public function getRestartPolicy(): string
    {
        return $this->restartPolicy;
    }

    public function setResourceName(string $resourceName): self
    {
        $this->resourceName = $resourceName;

        return $this;
    }

    public function setRestartPolicy(string $restartPolicy): self
    {
        $this->restartPolicy = $restartPolicy;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'resourceName' => $this->resourceName,
            'restartPolicy' => $this->restartPolicy,
        ];
    }
}
