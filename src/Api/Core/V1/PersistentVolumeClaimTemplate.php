<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * PersistentVolumeClaimTemplate is used to produce PersistentVolumeClaim objects
 * as part of an EphemeralVolumeSource.
 */
class PersistentVolumeClaimTemplate implements JsonSerializable
{
    /**
     * May contain labels and annotations that will be copied into the PVC when
     * creating it. No other fields are allowed and will be rejected during validation.
     */
    private ObjectMeta $metadata;

    /**
     * The specification for the PersistentVolumeClaim. The entire content is copied
     * unchanged into the PVC that gets created from this template. The same fields as
     * in a PersistentVolumeClaim are also valid here.
     */
    private PersistentVolumeClaimSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new PersistentVolumeClaimSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setMetadata(ObjectMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setSpec(PersistentVolumeClaimSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function spec(): PersistentVolumeClaimSpec
    {
        return $this->spec;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ]);
    }
}
