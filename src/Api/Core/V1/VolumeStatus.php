<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * VolumeStatus represents the status of a mounted volume. At most one of its
 * members must be specified.
 */
class VolumeStatus implements JsonSerializable
{
    /**
     * image represents an OCI object (a container image or artifact) pulled and
     * mounted on the kubelet's host machine.
     */
    private ImageVolumeStatus|null $image = null;

    public function __construct()
    {
    }

    public function getImage(): ImageVolumeStatus|null
    {
        return $this->image;
    }

    public function setImage(ImageVolumeStatus $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'image' => $this->image,
        ]);
    }
}
