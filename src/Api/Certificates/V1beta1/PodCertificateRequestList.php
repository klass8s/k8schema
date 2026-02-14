<?php

declare(strict_types=1);

namespace K8Schema\Api\Certificates\V1beta1;

use ArrayObject;
use K8Schema\APIResourceListInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ListMeta;

/**
 * PodCertificateRequestList is a collection of PodCertificateRequest objects
 */
class PodCertificateRequestList implements APIResourceListInterface
{
    public const string API_VERSION = 'certificates.k8s.io/v1beta1';
    public const string KIND = 'PodCertificateRequestList';

    /**
     * @var PodCertificateRequest[]
     */
    private array $items;

    /**
     * metadata contains the list metadata.
     */
    private ListMeta|null $metadata = null;

    public function __construct()
    {
        $this->clear();
        $this->items = [];
    }

    public function add(PodCertificateRequest $value): self
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
     * @return PodCertificateRequest[]
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
