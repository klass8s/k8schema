<?php

declare(strict_types=1);

namespace K8Schema\Api\Certificates\V1beta1;

use K8Schema\APIResourceListInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ListMeta;

/**
 * ClusterTrustBundleList is a collection of ClusterTrustBundle objects
 */
class ClusterTrustBundleList implements APIResourceListInterface
{
    public const string API_VERSION = 'certificates.k8s.io/v1beta1';
    public const string KIND = 'ClusterTrustBundleList';

    /**
     * @var ClusterTrustBundle[]
     */
    private array $items = [];

    /**
     * metadata contains the list metadata.
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->clear();
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(ClusterTrustBundle $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var ClusterTrustBundle[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        foreach ($items as $value) {
            $this->add($value);
        }

        return $this;
    }

    /**
     * @return ClusterTrustBundle[]
     */
    public function all(): array
    {
        return $this->items;
    }

    public function clear(): self
    {
        $this->items = [];

        return $this;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function metadata(): ListMeta
    {
        return $this->metadata;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'items' => $this->items,
            'metadata' => $this->metadata,
        ];
    }
}
