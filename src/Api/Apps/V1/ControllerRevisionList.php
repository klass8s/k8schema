<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
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
    private array $items;

    /**
     * More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ListMeta|null $metadata = null;

    public function __construct()
    {
        $this->clear();
        $this->items = [];
    }

    public function add(ControllerRevision $value): self
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
        return $this->metadata ??= new ListMeta();
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
