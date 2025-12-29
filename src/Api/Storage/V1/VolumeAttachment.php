<?php

declare(strict_types=1);

namespace K8Schema\Api\Storage\V1;

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
     * Standard object metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec represents specification of the desired attach/detach volume behavior.
     * Populated by the Kubernetes system.
     */
    private VolumeAttachmentSpec $spec;

    public function __construct(VolumeAttachmentSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): VolumeAttachmentSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(VolumeAttachmentSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
