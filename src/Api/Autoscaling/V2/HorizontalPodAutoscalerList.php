<?php

declare(strict_types=1);

namespace K8Schema\Api\Autoscaling\V2;

use K8Schema\APIResourceListInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ListMeta;

/**
 * HorizontalPodAutoscalerList is a list of horizontal pod autoscaler objects.
 */
class HorizontalPodAutoscalerList implements APIResourceListInterface
{
    public const string API_VERSION = 'autoscaling/v2';
    public const string KIND = 'HorizontalPodAutoscalerList';

    /**
     * @var HorizontalPodAutoscaler[]
     */
    private array $items = [];

    /**
     * metadata is the standard list metadata.
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->clear();
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(HorizontalPodAutoscaler $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var HorizontalPodAutoscaler[] $items
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
     * @return HorizontalPodAutoscaler[]
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
