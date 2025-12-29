<?php

declare(strict_types=1);

namespace K8Schema\Api\Coordination\V1beta1;

use K8Schema\APIResourceListInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ListMeta;

/**
 * LeaseCandidateList is a list of Lease objects.
 */
class LeaseCandidateList implements APIResourceListInterface
{
    public const string API_VERSION = 'coordination.k8s.io/v1beta1';
    public const string KIND = 'LeaseCandidateList';

    /**
     * @var LeaseCandidate[]
     */
    private array $items = [];

    /**
     * Standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->clear();
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(LeaseCandidate $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var LeaseCandidate[] $items
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
     * @return LeaseCandidate[]
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
