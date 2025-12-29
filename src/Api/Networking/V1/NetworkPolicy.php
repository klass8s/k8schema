<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * NetworkPolicy describes what network traffic is allowed for a set of Pods
 */
class NetworkPolicy implements APIResourceInterface
{
    public const string API_VERSION = 'networking.k8s.io/v1';
    public const string KIND = 'NetworkPolicy';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec represents the specification of the desired behavior for this
     * NetworkPolicy.
     */
    private NetworkPolicySpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new NetworkPolicySpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): NetworkPolicySpec
    {
        return $this->spec;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
