<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * DaemonSet represents the configuration of a daemon set.
 */
class DaemonSet implements APIResourceInterface
{
    public const string API_VERSION = 'apps/v1';
    public const string KIND = 'DaemonSet';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * The desired behavior of this daemon set. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private DaemonSetSpec $spec;

    /**
     * The current status of this daemon set. This data may be out of date by some
     * window of time. Populated by the system. Read-only. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private DaemonSetStatus|null $status = null;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new DaemonSetSpec();
    }

    public function getStatus(): DaemonSetStatus|null
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

    public function setSpec(DaemonSetSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(DaemonSetStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function spec(): DaemonSetSpec
    {
        return $this->spec;
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
