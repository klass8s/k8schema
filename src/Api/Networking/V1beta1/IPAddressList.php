<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1beta1;

use K8Schema\APIResourceListInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ListMeta;

/**
 * IPAddressList contains a list of IPAddress.
 */
class IPAddressList implements APIResourceListInterface
{
    public const string API_VERSION = 'networking.k8s.io/v1beta1';
    public const string KIND = 'IPAddressList';

    /**
     * @var IPAddress[]
     */
    private array $items = [];

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->clear();
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(IPAddress $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var IPAddress[] $items
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
     * @return IPAddress[]
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
