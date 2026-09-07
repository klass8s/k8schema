<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * Represents a projected volume source
 */
class ProjectedVolumeSource implements JsonSerializable
{
    /**
     * defaultMode are the mode bits used to set permissions on created files by
     * default. Must be an octal value between 0000 and 0777 or a decimal value between
     * 0 and 511. YAML accepts both octal and decimal values, JSON requires decimal
     * values for mode bits. Directories within the path are not affected by this
     * setting. This might be in conflict with other options that affect the file mode,
     * like fsGroup, and the result can be other mode bits set.
     */
    private int|null $defaultMode = null;

    /**
     * defaultUser is Optional: The owner UID of the created files by default. The
     * defaultUser field is only used as a fallback when the item-level user field is
     * unset. (Alpha) This field requires the AtomicWriteVolumeUserFields feature gate
     * to be enabled.
     */
    private int|null $defaultUser = null;

    /**
     * sources is the list of volume projections. Each entry in this list handles one
     * source.
     */
    private VolumeProjectionList $sources;

    public function __construct()
    {
        $this->sources = new VolumeProjectionList();
    }

    public function getDefaultMode(): int|null
    {
        return $this->defaultMode;
    }

    public function getDefaultUser(): int|null
    {
        return $this->defaultUser;
    }

    public function setDefaultMode(int $defaultMode): self
    {
        $this->defaultMode = $defaultMode;

        return $this;
    }

    public function setDefaultUser(int $defaultUser): self
    {
        $this->defaultUser = $defaultUser;

        return $this;
    }

    public function setSources(VolumeProjectionList $sources): self
    {
        $this->sources = $sources;

        return $this;
    }

    public function sources(): VolumeProjectionList
    {
        return $this->sources;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'defaultMode' => $this->defaultMode,
            'defaultUser' => $this->defaultUser,
            'sources' => $this->sources,
        ]);
    }
}
