<?php

declare(strict_types=1);

namespace K8Schema\Api\Flowcontrol\V1;

use K8Schema\APIResourceListInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ListMeta;

/**
 * PriorityLevelConfigurationList is a list of PriorityLevelConfiguration objects.
 */
class PriorityLevelConfigurationList implements APIResourceListInterface
{
    public const string API_VERSION = 'flowcontrol.apiserver.k8s.io/v1';
    public const string KIND = 'PriorityLevelConfigurationList';

    /**
     * @var PriorityLevelConfiguration[]
     */
    private array $items = [];

    /**
     * `metadata` is the standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->clear();
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(PriorityLevelConfiguration $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var PriorityLevelConfiguration[] $items
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
     * @return PriorityLevelConfiguration[]
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
