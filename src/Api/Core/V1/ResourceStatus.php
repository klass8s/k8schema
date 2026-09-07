<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ResourceStatus represents the status of a single resource allocated to a Pod.
 */
class ResourceStatus implements JsonSerializable
{
    /**
     * Name of the resource. Must be unique within the pod and in case of non-DRA
     * resource, match one of the resources from the pod spec. For DRA resources, the
     * value must be "claim:<claim_name>/<request>" when
     * container.resources.claims[*].request is set or "claim:<claim_name>" when
     * container.resources.claims[*].request is empty. For DRA-backed extended
     * resources, "claim:<claim_name>/<request>" is used when the claim name and
     * request name are recorded in pod.status.extendedResourceClaimStatus. When this
     * status is reported about a container, the "claim_name" and "request" must match
     * one of the claims of this container.
     */
    private string $name;

    /**
     * List of unique resources health. Each element in the list contains an unique
     * resource ID and its health. At a minimum, for the lifetime of a Pod, resource ID
     * must uniquely identify the resource allocated to the Pod on the Node. If other
     * Pod on the same Node reports the status with the same resource ID, it must be
     * the same resource they share. See ResourceID type definition for a specific
     * format it has in various use cases.
     */
    private ResourceHealthList $resources;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->resources = new ResourceHealthList();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function resources(): ResourceHealthList
    {
        return $this->resources;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setResources(ResourceHealthList $resources): self
    {
        $this->resources = $resources;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'resources' => $this->resources,
        ]);
    }
}
