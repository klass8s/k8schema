<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use K8Schema\APIResourceListInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ListMeta;

/**
 * ControllerRevisionList is a resource containing a list of ControllerRevision
 * objects.
 */
class ControllerRevisionList implements APIResourceListInterface
{
    public const string API_VERSION = 'apps/v1';
    public const string KIND = 'ControllerRevisionList';

    /**
     * @var ControllerRevision[]
     */
    private array $items = [];

    /**
     * More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->clear();
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(ControllerRevision $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var ControllerRevision[] $items
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
     * @return ControllerRevision[]
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
