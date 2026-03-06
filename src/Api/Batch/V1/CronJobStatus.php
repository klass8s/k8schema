<?php

declare(strict_types=1);

namespace K8Schema\Api\Batch\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Api\Core\V1\ObjectReferenceList;
use K8Schema\DateTimeInterface;

/**
 * CronJobStatus represents the current state of a cron job.
 */
class CronJobStatus implements JsonSerializable
{
    /**
     * A list of pointers to currently running jobs.
     */
    private ObjectReferenceList $active;

    /**
     * Information when was the last time the job was successfully scheduled.
     */
    private DateTimeInterface|null $lastScheduleTime = null;

    /**
     * Information when was the last time the job successfully completed.
     */
    private DateTimeInterface|null $lastSuccessfulTime = null;

    public function __construct()
    {
        $this->active = new ObjectReferenceList();
    }

    public function active(): ObjectReferenceList
    {
        return $this->active;
    }

    public function getLastScheduleTime(): DateTimeInterface|null
    {
        return $this->lastScheduleTime;
    }

    public function getLastSuccessfulTime(): DateTimeInterface|null
    {
        return $this->lastSuccessfulTime;
    }

    public function setActive(ObjectReferenceList $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function setLastScheduleTime(DateTimeInterface $lastScheduleTime): self
    {
        $this->lastScheduleTime = $lastScheduleTime;

        return $this;
    }

    public function setLastSuccessfulTime(DateTimeInterface $lastSuccessfulTime): self
    {
        $this->lastSuccessfulTime = $lastSuccessfulTime;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'active' => $this->active,
            'lastScheduleTime' => $this->lastScheduleTime,
            'lastSuccessfulTime' => $this->lastSuccessfulTime,
        ]);
    }
}
