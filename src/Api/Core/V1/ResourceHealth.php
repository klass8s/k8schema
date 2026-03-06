<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ResourceHealth represents the health of a resource. It has the latest device
 * health information. This is a part of KEP https://kep.k8s.io/4680.
 */
class ResourceHealth implements JsonSerializable
{
    /**
     * Health of the resource. can be one of:
     *  - Healthy: operates as normal
     *  - Unhealthy: reported unhealthy. We consider this a temporary health issue
     *               since we do not have a mechanism today to distinguish
     *               temporary and permanent issues.
     *  - Unknown: The status cannot be determined.
     *             For example, Device Plugin got unregistered and hasn't been
     * re-registered since.
     *
     * In future we may want to introduce the PermanentlyUnhealthy Status.
     */
    private string|null $health = null;

    /**
     * ResourceID is the unique identifier of the resource. See the ResourceID type for
     * more information.
     */
    private string $resourceID;

    public function __construct(string $resourceID)
    {
        $this->resourceID = $resourceID;
    }

    public function getHealth(): string|null
    {
        return $this->health;
    }

    public function getResourceID(): string
    {
        return $this->resourceID;
    }

    public function setHealth(string $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function setResourceID(string $resourceID): self
    {
        $this->resourceID = $resourceID;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'health' => $this->health,
            'resourceID' => $this->resourceID,
        ]);
    }
}
