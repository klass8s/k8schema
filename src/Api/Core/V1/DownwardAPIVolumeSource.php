<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * DownwardAPIVolumeSource represents a volume containing downward API info.
 * Downward API volumes support ownership management and SELinux relabeling.
 */
class DownwardAPIVolumeSource implements JsonSerializable
{
    /**
     * Optional: mode bits to use on created files by default. Must be a Optional: mode
     * bits used to set permissions on created files by default. Must be an octal value
     * between 0000 and 0777 or a decimal value between 0 and 511. YAML accepts both
     * octal and decimal values, JSON requires decimal values for mode bits. Defaults
     * to 0644. Directories within the path are not affected by this setting. This
     * might be in conflict with other options that affect the file mode, like fsGroup,
     * and the result can be other mode bits set.
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
     * Items is a list of downward API volume file
     */
    private DownwardAPIVolumeFileList $items;

    public function __construct()
    {
        $this->items = new DownwardAPIVolumeFileList();
    }

    public function getDefaultMode(): int|null
    {
        return $this->defaultMode;
    }

    public function getDefaultUser(): int|null
    {
        return $this->defaultUser;
    }

    public function items(): DownwardAPIVolumeFileList
    {
        return $this->items;
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

    public function setItems(DownwardAPIVolumeFileList $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'defaultMode' => $this->defaultMode,
            'defaultUser' => $this->defaultUser,
            'items' => $this->items,
        ]);
    }
}
