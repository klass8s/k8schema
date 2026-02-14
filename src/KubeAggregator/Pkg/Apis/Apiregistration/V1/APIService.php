<?php

declare(strict_types=1);

namespace K8Schema\KubeAggregator\Pkg\Apis\Apiregistration\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * APIService represents a server for a particular GroupVersion. Name must be
 * "version.group".
 */
class APIService implements APIResourceInterface
{
    public const string API_VERSION = 'apiregistration.k8s.io/v1';
    public const string KIND = 'APIService';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec contains information for locating and communicating with a server
     */
    private APIServiceSpec $spec;

    public function __construct(APIServiceSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): APIServiceSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(APIServiceSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ]);
    }
}
