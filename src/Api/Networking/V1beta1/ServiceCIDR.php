<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1beta1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ServiceCIDR defines a range of IP addresses using CIDR format (e.g.
 * 192.168.0.0/24 or 2001:db2::/64). This range is used to allocate ClusterIPs to
 * Service objects.
 */
class ServiceCIDR implements APIResourceInterface
{
    public const string API_VERSION = 'networking.k8s.io/v1beta1';
    public const string KIND = 'ServiceCIDR';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec is the desired state of the ServiceCIDR. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private ServiceCIDRSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ServiceCIDRSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setMetadata(ObjectMeta $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setSpec(ServiceCIDRSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function spec(): ServiceCIDRSpec
    {
        return $this->spec;
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
