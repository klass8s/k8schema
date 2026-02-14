<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\LabelSelector;

/**
 * ClusterTrustBundleProjection describes how to select a set of ClusterTrustBundle
 * objects and project their contents into the pod filesystem.
 */
class ClusterTrustBundleProjection implements JsonSerializable
{
    /**
     * Select all ClusterTrustBundles that match this label selector.  Only has effect
     * if signerName is set.  Mutually-exclusive with name.  If unset, interpreted as
     * "match nothing".  If set but empty, interpreted as "match everything".
     */
    private LabelSelector|null $labelSelector = null;

    /**
     * Select a single ClusterTrustBundle by object name.  Mutually-exclusive with
     * signerName and labelSelector.
     */
    private string|null $name = null;

    /**
     * If true, don't block pod startup if the referenced ClusterTrustBundle(s) aren't
     * available.  If using name, then the named ClusterTrustBundle is allowed not to
     * exist.  If using signerName, then the combination of signerName and
     * labelSelector is allowed to match zero ClusterTrustBundles.
     */
    private bool|null $optional = null;

    /**
     * Relative path from the volume root to write the bundle.
     */
    private string $path;

    /**
     * Select all ClusterTrustBundles that match this signer name. Mutually-exclusive
     * with name.  The contents of all selected ClusterTrustBundles will be unified and
     * deduplicated.
     */
    private string|null $signerName = null;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getOptional(): bool|null
    {
        return $this->optional;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getSignerName(): string|null
    {
        return $this->signerName;
    }

    public function labelSelector(): LabelSelector
    {
        return $this->labelSelector ??= new LabelSelector();
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setOptional(bool $optional): self
    {
        $this->optional = $optional;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setSignerName(string $signerName): self
    {
        $this->signerName = $signerName;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'labelSelector' => $this->labelSelector,
            'name' => $this->name,
            'optional' => $this->optional,
            'path' => $this->path,
            'signerName' => $this->signerName,
        ]);
    }
}
