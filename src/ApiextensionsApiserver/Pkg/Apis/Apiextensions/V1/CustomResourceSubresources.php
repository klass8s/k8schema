<?php

declare(strict_types=1);

namespace K8Schema\ApiextensionsApiserver\Pkg\Apis\Apiextensions\V1;

use ArrayObject;
use JsonSerializable;

/**
 * CustomResourceSubresources defines the status and scale subresources for
 * CustomResources.
 */
class CustomResourceSubresources implements JsonSerializable
{
    /**
     * scale indicates the custom resource should serve a `/scale` subresource that
     * returns an `autoscaling/v1` Scale object.
     */
    private CustomResourceSubresourceScale|null $scale = null;

    /**
     * status indicates the custom resource should serve a `/status` subresource. When
     * enabled: 1. requests to the custom resource primary endpoint ignore changes to
     * the `status` stanza of the object. 2. requests to the custom resource `/status`
     * subresource ignore changes to anything other than the `status` stanza of the
     * object.
     */
    private CustomResourceSubresourceStatus|null $status = null;

    public function __construct()
    {
    }

    public function getScale(): CustomResourceSubresourceScale|null
    {
        return $this->scale;
    }

    public function getStatus(): CustomResourceSubresourceStatus|null
    {
        return $this->status;
    }

    public function setScale(CustomResourceSubresourceScale $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    public function setStatus(CustomResourceSubresourceStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function status(): CustomResourceSubresourceStatus
    {
        return $this->status ??= new CustomResourceSubresourceStatus();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'scale' => $this->scale,
            'status' => $this->status,
        ]);
    }
}
