<?php

declare(strict_types=1);

namespace K8Schema\Api\Storage\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * VolumeAttachment captures the intent to attach or detach the specified volume
 * to/from the specified node.
 *
 * VolumeAttachment objects are non-namespaced.
 */
class VolumeAttachment implements APIResourceInterface
{
    public const string API_VERSION = 'storage.k8s.io/v1';
    public const string KIND = 'VolumeAttachment';

    /**
     * metadata is the standard object metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec represents specification of the desired attach/detach volume behavior.
     * Populated by the Kubernetes system.
     */
    private VolumeAttachmentSpec $spec;

    /**
     * status represents status of the VolumeAttachment request. Populated by the
     * entity completing the attach or detach operation, i.e. the external-attacher.
     */
    private VolumeAttachmentStatus|null $status = null;

    public function __construct(VolumeAttachmentSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): VolumeAttachmentSpec
    {
        return $this->spec;
    }

    public function getStatus(): VolumeAttachmentStatus|null
    {
        return $this->status;
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

    public function setSpec(VolumeAttachmentSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(VolumeAttachmentStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
            'status' => $this->status,
        ]);
    }
}
