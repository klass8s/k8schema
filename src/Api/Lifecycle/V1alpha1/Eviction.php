<?php

declare(strict_types=1);

namespace K8Schema\Api\Lifecycle\V1alpha1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * Eviction initiates an eviction process, which should ideally result in a
 * graceful eviction of a .spec.target (e.g. termination of a pod).
 *
 * The evictionrequest-controller observes intents of all EvictionRequests and
 * transforms them into Evictions. It manages the Eviction lifecycle. Requesters
 * are preserved in .status.requesters even after they have withdrawn their
 * request. If all requesters withdraw their eviction intent for a common target,
 * the eviction will be canceled. Once all EvictionRequest corresponding to this
 * Eviction .spec.target have been removed, this Eviction object will eventually be
 * garbage collected.
 *
 * If the target is a pod, the .status.targetResponders is populated from Pod's
 * .spec.evictionResponders.
 *
 * Responders should observe and communicate through the .status to help with the
 * eviction of the target when they see their state == Active in
 * .status.targetResponders. ResponderStatus struct should then be periodically
 * updated to indicate the progress or completion of the eviction process by each
 * responder in .status.responders. If .status.responders[].heartbeatTime is not
 * updated within the heartbeat deadline defined by the Eviction API (currently 20
 * minutes), the eviction is passed over to the next responder with a lower
 * priority.
 *
 * If there are no other responders and the target is a pod, the last default
 * imperative-eviction.k8s.io/evictor responder with a priority of 100 will evict
 * the pod using the imperative Eviction API (pods/<name>/eviction subresource).
 */
class Eviction implements JsonSerializable
{
    /**
     * APIVersion defines the versioned schema of this representation of an object.
     * Servers should convert recognized schemas to the latest internal value, and may
     * reject unrecognized values. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#resources
     */
    private string|null $apiVersion = null;

    /**
     * Kind is a string value representing the REST resource this object represents.
     * Servers may infer this from the endpoint the client submits requests to. Cannot
     * be updated. In CamelCase. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds
     */
    private string|null $kind = null;

    /**
     * metadata is the standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     * .metadata.name set by the evictionrequest-controller is purely informative and
     * subject to change. .spec.target field should be used to identify the target
     * precisesly.
     *
     * The requester and responder names will be used as label keys and added to the
     * labels of the eviction in one of the following formats: 1. acme.io/foo:
     * "requester" 2. acme.io/foo: "responder" 3. acme.io/foo: "requester-responder"
     *
     * Please see EvictionParticipantRole for available role label values.
     */
    private ObjectMeta $metadata;

    /**
     * spec defines the eviction specification.
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private EvictionSpec $spec;

    /**
     * status represents the most recently observed status of the eviction. Populated
     * by responders and evictionrequest-controller. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private EvictionStatus|null $status = null;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new EvictionSpec();
    }

    public function getApiVersion(): string|null
    {
        return $this->apiVersion;
    }

    public function getKind(): string|null
    {
        return $this->kind;
    }

    public function getStatus(): EvictionStatus|null
    {
        return $this->status;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setApiVersion(string $apiVersion): self
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function setMetadata(ObjectMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setSpec(EvictionSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(EvictionStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function spec(): EvictionSpec
    {
        return $this->spec;
    }

    public function status(): EvictionStatus
    {
        return $this->status ??= new EvictionStatus();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => $this->apiVersion,
            'kind' => $this->kind,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
            'status' => $this->status,
        ]);
    }
}
