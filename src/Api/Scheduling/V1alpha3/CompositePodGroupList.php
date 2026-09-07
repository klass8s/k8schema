<?php

declare(strict_types=1);

namespace K8Schema\Api\Scheduling\V1alpha3;

use ArrayObject;
use K8Schema\APIResourceListInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ListMeta;

/**
 * CompositePodGroupList contains a list of CompositePodGroup resources.
 */
class CompositePodGroupList implements APIResourceListInterface
{
    public const string API_VERSION = 'scheduling.k8s.io/v1alpha3';
    public const string KIND = 'CompositePodGroupList';

    /**
     * @var CompositePodGroup[]
     */
    private array $items;

    /**
     * Standard list metadata.
     */
    private ListMeta|null $metadata = null;

    public function __construct()
    {
        $this->clear();
        $this->items = [];
    }

    public function add(CompositePodGroup $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    public function addAll(array $items): self
    {
        foreach ($items as $value) {
            $this->add($value);
        }

        return $this;
    }

    /**
     * @return CompositePodGroup[]
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

    public function getMetadata(): ListMeta|null
    {
        return $this->metadata;
    }

    public function metadata(): ListMeta
    {
        return $this->metadata ??= new ListMeta();
    }

    public function setMetadata(ListMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'items' => $this->items,
            'metadata' => $this->metadata,
        ]);
    }
}
