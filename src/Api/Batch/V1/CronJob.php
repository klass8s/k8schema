<?php

declare(strict_types=1);

namespace K8Schema\Api\Batch\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * CronJob represents the configuration of a single cron job.
 */
class CronJob implements APIResourceInterface
{
    public const string API_VERSION = 'batch/v1';
    public const string KIND = 'CronJob';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of a cron job, including the schedule.
     * More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private CronJobSpec $spec;

    /**
     * Current status of a cron job. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private CronJobStatus|null $status = null;

    public function __construct(CronJobSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): CronJobSpec
    {
        return $this->spec;
    }

    public function getStatus(): CronJobStatus|null
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

    public function setSpec(CronJobSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(CronJobStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function status(): CronJobStatus
    {
        return $this->status ??= new CronJobStatus();
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
