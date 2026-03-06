<?php

declare(strict_types=1);

namespace K8Schema\Api\Batch\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * UncountedTerminatedPods holds UIDs of Pods that have terminated but haven't been
 * accounted in Job status counters.
 */
class UncountedTerminatedPods implements JsonSerializable
{
    /**
     * failed holds UIDs of failed Pods.
     */
    private StringList $failed;

    /**
     * succeeded holds UIDs of succeeded Pods.
     */
    private StringList $succeeded;

    public function __construct()
    {
        $this->failed = new StringList();
        $this->succeeded = new StringList();
    }

    public function failed(): StringList
    {
        return $this->failed;
    }

    public function setFailed(StringList $failed): self
    {
        $this->failed = $failed;

        return $this;
    }

    public function setSucceeded(StringList $succeeded): self
    {
        $this->succeeded = $succeeded;

        return $this;
    }

    public function succeeded(): StringList
    {
        return $this->succeeded;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'failed' => $this->failed,
            'succeeded' => $this->succeeded,
        ]);
    }
}
