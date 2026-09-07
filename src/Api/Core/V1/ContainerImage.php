<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * Describe a container image
 */
class ContainerImage implements JsonSerializable
{
    /**
     * Names by which this image is known. e.g. ["kubernetes.example/hyperkube:v1.0.7",
     * "cloud-vendor.registry.example/cloud-vendor/hyperkube:v1.0.7"]
     */
    private StringList $names;

    /**
     * The size of the image in bytes.
     */
    private int|null $sizeBytes = null;

    public function __construct()
    {
        $this->names = new StringList();
    }

    public function getSizeBytes(): int|null
    {
        return $this->sizeBytes;
    }

    public function names(): StringList
    {
        return $this->names;
    }

    public function setNames(StringList $names): self
    {
        $this->names = $names;

        return $this;
    }

    public function setSizeBytes(int $sizeBytes): self
    {
        $this->sizeBytes = $sizeBytes;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'names' => $this->names,
            'sizeBytes' => $this->sizeBytes,
        ]);
    }
}
