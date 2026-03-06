<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * StatefulSet represents a set of pods with consistent identities. Identities are
 * defined as:
 *   - Network: A single stable DNS and hostname.
 *   - Storage: As many VolumeClaims as requested.
 *
 * The StatefulSet guarantees that a given network identity will always map to the
 * same storage identity.
 */
class StatefulSet implements APIResourceInterface
{
    public const string API_VERSION = 'apps/v1';
    public const string KIND = 'StatefulSet';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec defines the desired identities of pods in this set.
     */
    private StatefulSetSpec $spec;

    /**
     * Status is the current status of Pods in this StatefulSet. This data may be out
     * of date by some window of time.
     */
    private StatefulSetStatus|null $status = null;

    public function __construct(StatefulSetSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): StatefulSetSpec
    {
        return $this->spec;
    }

    public function getStatus(): StatefulSetStatus|null
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

    public function setSpec(StatefulSetSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(StatefulSetStatus $status): self
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
