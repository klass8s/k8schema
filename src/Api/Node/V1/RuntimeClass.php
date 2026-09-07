<?php

declare(strict_types=1);

namespace K8Schema\Api\Node\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * RuntimeClass defines a class of container runtime supported in the cluster. The
 * RuntimeClass is used to determine which container runtime is used to run all
 * containers in a pod. RuntimeClasses are manually defined by a user or cluster
 * provisioner, and referenced in the PodSpec. The Kubelet is responsible for
 * resolving the RuntimeClassName reference before running the pod.  For more
 * details, see https://kubernetes.io/docs/concepts/containers/runtime-class/
 */
class RuntimeClass implements APIResourceInterface
{
    public const string API_VERSION = 'node.k8s.io/v1';
    public const string KIND = 'RuntimeClass';

    /**
     * handler specifies the underlying runtime and configuration that the CRI
     * implementation will use to handle pods of this class. The possible values are
     * specific to the node & CRI configuration.  It is assumed that all handlers are
     * available on every node, and handlers of the same name are equivalent on every
     * node. For example, a handler called "runc" might specify that the runc OCI
     * runtime (using native Linux containers) will be used to run the containers in a
     * pod. The Handler must be lowercase, conform to the DNS Label (RFC 1123)
     * requirements, and is immutable.
     */
    private string $handler;

    /**
     * metadata is the standard object metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta|null $metadata = null;

    /**
     * overhead represents the resource overhead associated with running a pod for a
     * given RuntimeClass. For more details, see
     *  https://kubernetes.io/docs/concepts/scheduling-eviction/pod-overhead/
     */
    private Overhead|null $overhead = null;

    /**
     * scheduling holds the scheduling constraints to ensure that pods running with
     * this RuntimeClass are scheduled to nodes that support it. If scheduling is nil,
     * this RuntimeClass is assumed to be supported by all nodes.
     */
    private Scheduling|null $scheduling = null;

    public function __construct(string $handler)
    {
        $this->handler = $handler;
    }

    public function getHandler(): string
    {
        return $this->handler;
    }

    public function getMetadata(): ObjectMeta|null
    {
        return $this->metadata;
    }

    public function getOverhead(): Overhead|null
    {
        return $this->overhead;
    }

    public function getScheduling(): Scheduling|null
    {
        return $this->scheduling;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata ??= new ObjectMeta();
    }

    public function overhead(): Overhead
    {
        return $this->overhead ??= new Overhead();
    }

    public function scheduling(): Scheduling
    {
        return $this->scheduling ??= new Scheduling();
    }

    public function setHandler(string $handler): self
    {
        $this->handler = $handler;

        return $this;
    }

    public function setMetadata(ObjectMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setOverhead(Overhead $overhead): self
    {
        $this->overhead = $overhead;

        return $this;
    }

    public function setScheduling(Scheduling $scheduling): self
    {
        $this->scheduling = $scheduling;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'handler' => $this->handler,
            'metadata' => $this->metadata,
            'overhead' => $this->overhead,
            'scheduling' => $this->scheduling,
        ]);
    }
}
