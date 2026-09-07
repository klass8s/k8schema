<?php

declare(strict_types=1);

namespace K8Schema\Api\Networking\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * IPAddress represents a single IP of a single IP Family. The object is designed
 * to be used by APIs that operate on IP addresses. The object is used by the
 * Service core API for allocation of IP addresses. An IP address can be
 * represented in different formats, to guarantee the uniqueness of the IP, the
 * name of the object is the IP address in canonical format, four decimal digits
 * separated by dots suppressing leading zeros for IPv4 and the representation
 * defined by RFC 5952 for IPv6. Valid: 192.168.1.5 or 2001:db8::1 or
 * 2001:db8:aaaa:bbbb:cccc:dddd:eeee:1 Invalid: 10.01.2.3 or 2001:db8:0:0:0::1
 */
class IPAddress implements APIResourceInterface
{
    public const string API_VERSION = 'networking.k8s.io/v1';
    public const string KIND = 'IPAddress';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec is the desired state of the IPAddress. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private IPAddressSpec $spec;

    public function __construct(IPAddressSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): IPAddressSpec
    {
        return $this->spec;
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

    public function setSpec(IPAddressSpec $spec): self
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
