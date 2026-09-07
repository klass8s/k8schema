<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * ImageVolumeStatus represents the image-based volume status.
 */
class ImageVolumeStatus implements JsonSerializable
{
    /**
     * ImageRef is the digest of the image used for this volume. It should have a value
     * that's similar to the pod's status.containerStatuses[i].imageID. The ImageRef
     * length should not exceed 256 characters.
     */
    private string $imageRef;

    public function __construct(string $imageRef)
    {
        $this->imageRef = $imageRef;
    }

    public function getImageRef(): string
    {
        return $this->imageRef;
    }

    public function setImageRef(string $imageRef): self
    {
        $this->imageRef = $imageRef;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'imageRef' => $this->imageRef,
        ]);
    }
}
