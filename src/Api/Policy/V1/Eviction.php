<?php

declare(strict_types=1);

namespace K8Schema\Api\Policy\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\DeleteOptions;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * Eviction evicts a pod from its node subject to certain policies and safety
 * constraints. This is a subresource of Pod.  A request to cause such an eviction
 * is created by POSTing to .../pods/<pod name>/evictions.
 */
class Eviction implements APIResourceInterface
{
    public const string API_VERSION = 'policy/v1';
    public const string KIND = 'Eviction';

    /**
     * DeleteOptions may be provided
     */
    private DeleteOptions|null $deleteOptions = null;

    /**
     * ObjectMeta describes the pod that is being evicted.
     */
    private ObjectMeta|null $metadata = null;

    public function __construct()
    {
    }

    public function deleteOptions(): DeleteOptions
    {
        return $this->deleteOptions ??= new DeleteOptions();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata ??= new ObjectMeta();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'deleteOptions' => $this->deleteOptions,
            'metadata' => $this->metadata,
        ]);
    }
}
