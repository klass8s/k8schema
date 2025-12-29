<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use K8Schema\APIResourceListInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ListMeta;

/**
 * EndpointsList is a list of endpoints. Deprecated: This API is deprecated in
 * v1.33+.
 */
class EndpointsList implements APIResourceListInterface
{
    public const string API_VERSION = 'v1';
    public const string KIND = 'EndpointsList';

    /**
     * @var Endpoints[]
     */
    private array $items = [];

    /**
     * Standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->clear();
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(Endpoints $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var Endpoints[] $items
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
     * @return Endpoints[]
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
