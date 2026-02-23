<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ResourceClaim references one entry in PodSpec.ResourceClaims.
 */
class ResourceClaim implements JsonSerializable
{
    /**
     * Name must match the name of one entry in pod.spec.resourceClaims of the Pod
     * where this field is used. It makes that resource available inside a container.
     */
    private string $name;

    /**
     * Request is the name chosen for a request in the referenced claim. If empty,
     * everything from the claim is made available, otherwise only the result of this
     * request.
     */
    private string|null $request = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRequest(): string|null
    {
        return $this->request;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setRequest(string $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'name' => $this->name,
            'request' => $this->request,
        ]);
    }
}
