<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NodeRuntimeHandlerFeatures is a set of features implemented by the runtime
 * handler.
 */
class NodeRuntimeHandlerFeatures implements JsonSerializable
{
    /**
     * RecursiveReadOnlyMounts is set to true if the runtime handler supports
     * RecursiveReadOnlyMounts.
     */
    private bool|null $recursiveReadOnlyMounts = null;

    /**
     * UserNamespaces is set to true if the runtime handler supports UserNamespaces,
     * including for volumes.
     */
    private bool|null $userNamespaces = null;

    public function __construct()
    {
    }

    public function getRecursiveReadOnlyMounts(): bool|null
    {
        return $this->recursiveReadOnlyMounts;
    }

    public function getUserNamespaces(): bool|null
    {
        return $this->userNamespaces;
    }

    public function setRecursiveReadOnlyMounts(bool $recursiveReadOnlyMounts): self
    {
        $this->recursiveReadOnlyMounts = $recursiveReadOnlyMounts;

        return $this;
    }

    public function setUserNamespaces(bool $userNamespaces): self
    {
        $this->userNamespaces = $userNamespaces;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'recursiveReadOnlyMounts' => $this->recursiveReadOnlyMounts,
            'userNamespaces' => $this->userNamespaces,
        ]);
    }
}
