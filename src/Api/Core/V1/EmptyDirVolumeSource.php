<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * Represents an empty directory for a pod. Empty directory volumes support
 * ownership management and SELinux relabeling.
 */
class EmptyDirVolumeSource implements JsonSerializable
{
    /**
     * medium represents what type of storage medium should back this directory. The
     * default is "" which means to use the node's default medium. Must be an empty
     * string (default) or Memory. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#emptydir
     */
    private string|null $medium = null;

    /**
     * mode specifies the permission bits for the emptyDir directory, in numeric
     * notation (e.g., 0755, 01777). Must be a value between 0000 and 01777. If not
     * specified, defaults to 0777. This might be in conflict with other options that
     * affect the file mode, like fsGroup. If fsGroup is specified, the fsGroup
     * permissions will override the mode specified here. This field has no effect on
     * Windows. This field is alpha and requires EmptyDirVolumeMode featuregate to be
     * enabled.
     */
    private int|null $mode = null;

    /**
     * sizeLimit is the total amount of local storage required for this EmptyDir
     * volume. The size limit is also applicable for memory medium. The maximum usage
     * on memory medium EmptyDir would be the minimum value between the SizeLimit
     * specified here and the sum of memory limits of all containers in a pod. The
     * default is nil which means that the limit is undefined. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#emptydir
     */
    private string|float|null $sizeLimit = null;

    public function __construct()
    {
    }

    public function getMedium(): string|null
    {
        return $this->medium;
    }

    public function getMode(): int|null
    {
        return $this->mode;
    }

    public function getSizeLimit(): string|float|null
    {
        return $this->sizeLimit;
    }

    public function setMedium(string $medium): self
    {
        $this->medium = $medium;

        return $this;
    }

    public function setMode(int $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function setSizeLimit(string|float $sizeLimit): self
    {
        $this->sizeLimit = $sizeLimit;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'medium' => $this->medium,
            'mode' => $this->mode,
            'sizeLimit' => $this->sizeLimit,
        ]);
    }
}
