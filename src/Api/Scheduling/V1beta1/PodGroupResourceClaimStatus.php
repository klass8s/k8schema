<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1beta1;

use ArrayObject;
use JsonSerializable;

/**
 * PodGroupResourceClaimStatus is stored in the PodGroupStatus for each
 * PodGroupResourceClaim which references a ResourceClaimTemplate. It stores the
 * generated name for the corresponding ResourceClaim.
 */
class PodGroupResourceClaimStatus implements JsonSerializable
{
    /**
     * name uniquely identifies this resource claim inside the PodGroup. This must
     * match the name of an entry in podgroup.spec.resourceClaims, which implies that
     * the string must be a DNS_LABEL.
     */
    private string $name;

    /**
     * resourceClaimName is the name of the ResourceClaim that was generated for the
     * PodGroup in the namespace of the PodGroup. If this is unset, then generating a
     * ResourceClaim was not necessary. The podgroup.spec.resourceClaims entry can be
     * ignored in this case.
     */
    private string|null $resourceClaimName = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getResourceClaimName(): string|null
    {
        return $this->resourceClaimName;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setResourceClaimName(string $resourceClaimName): self
    {
        $this->resourceClaimName = $resourceClaimName;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'resourceClaimName' => $this->resourceClaimName,
        ]);
    }
}
