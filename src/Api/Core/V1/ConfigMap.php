<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;
use K8Schema\Collection\StringMap;

/**
 * ConfigMap holds configuration data for pods to consume.
 */
class ConfigMap implements APIResourceInterface
{
    public const string API_VERSION = 'v1';
    public const string KIND = 'ConfigMap';

    /**
     * BinaryData contains the binary data. Each key must consist of alphanumeric
     * characters, '-', '_' or '.'. BinaryData can contain byte sequences that are not
     * in the UTF-8 range. The keys stored in BinaryData must not overlap with the ones
     * in the Data field, this is enforced during validation process. Using this field
     * will require 1.10+ apiserver and kubelet.
     */
    private StringMap $binaryData;

    /**
     * Data contains the configuration data. Each key must consist of alphanumeric
     * characters, '-', '_' or '.'. Values with non-UTF-8 byte sequences must use the
     * BinaryData field. The keys stored in Data must not overlap with the keys in the
     * BinaryData field, this is enforced during validation process.
     */
    private StringMap $data;

    /**
     * Immutable, if set to true, ensures that data stored in the ConfigMap cannot be
     * updated (only object metadata can be modified). If not set to true, the field
     * can be modified at any time. Defaulted to nil.
     */
    private bool|null $immutable = null;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta|null $metadata = null;

    public function __construct()
    {
        $this->binaryData = new StringMap();
        $this->data = new StringMap();
    }

    public function binaryData(): StringMap
    {
        return $this->binaryData;
    }

    public function data(): StringMap
    {
        return $this->data;
    }

    public function getImmutable(): bool|null
    {
        return $this->immutable;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata ??= new ObjectMeta();
    }

    public function setImmutable(bool $immutable): self
    {
        $this->immutable = $immutable;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'binaryData' => $this->binaryData,
            'data' => $this->data,
            'immutable' => $this->immutable,
            'metadata' => $this->metadata,
        ]);
    }
}
