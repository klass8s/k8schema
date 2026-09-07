<?php

declare(strict_types=1);

namespace K8Schema\Api\Lifecycle\V1alpha1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * EvictionRequest defines a request that should ideally result in a graceful
 * eviction of a .spec.target (e.g. termination of a pod).
 *
 * The evictionrequest-controller observes intents of all EvictionRequests and
 * transforms them into Evictions.
 *   - .spec.requester is set as a label on the Eviction for easier lookup.
 *   - Each target can have a set of responders assigned to it. Eviction objects
 * are observed by
 *     these responders, who implement the eviction logic and update the Eviction's
 * status with
 *     progress.
 *
 * There is many-to-many relationship between EvictionRequests and Evictions in
 * general. And many-to-one if the target is a  pod.
 *
 * If all requesters withdraw their eviction intent for a common target, the
 * eviction will be canceled. Deleting an EvictionRequest also counts as a
 * withdrawal. Once all EvictionRequest of a target are removed, the corresponding
 * Evictions are eventually garbage collected.
 */
class EvictionRequest implements APIResourceInterface
{
    public const string API_VERSION = 'lifecycle.k8s.io/v1alpha1';
    public const string KIND = 'EvictionRequest';

    /**
     * metadata is the standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta $metadata;

    /**
     * spec defines the eviction request specification.
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private EvictionRequestSpec $spec;

    /**
     * status represents the most recently observed status of the eviction request.
     * More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private EvictionRequestStatus|null $status = null;

    public function __construct(EvictionRequestSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): EvictionRequestSpec
    {
        return $this->spec;
    }

    public function getStatus(): EvictionRequestStatus|null
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

    public function setSpec(EvictionRequestSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(EvictionRequestStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function status(): EvictionRequestStatus
    {
        return $this->status ??= new EvictionRequestStatus();
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
