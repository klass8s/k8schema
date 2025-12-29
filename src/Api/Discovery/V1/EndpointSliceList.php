<?php

declare(strict_types=1);

namespace K8Schema\Api\Discovery\V1;

use K8Schema\APIResourceListInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ListMeta;

/**
 * EndpointSliceList represents a list of endpoint slices
 */
class EndpointSliceList implements APIResourceListInterface
{
    public const string API_VERSION = 'discovery.k8s.io/v1';
    public const string KIND = 'EndpointSliceList';

    /**
     * @var EndpointSlice[]
     */
    private array $items = [];

    /**
     * Standard list metadata.
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->clear();
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(EndpointSlice $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var EndpointSlice[] $items
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
     * @return EndpointSlice[]
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
