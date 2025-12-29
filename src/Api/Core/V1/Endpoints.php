<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * Endpoints is a collection of endpoints that implement the actual service.
 * Example:
 *
 * 	 Name: "mysvc",
 * 	 Subsets: [
 * 	   {
 * 	     Addresses: [{"ip": "10.10.1.1"}, {"ip": "10.10.2.2"}],
 * 	     Ports: [{"name": "a", "port": 8675}, {"name": "b", "port": 309}]
 * 	   },
 * 	   {
 * 	     Addresses: [{"ip": "10.10.3.3"}],
 * 	     Ports: [{"name": "a", "port": 93}, {"name": "b", "port": 76}]
 * 	   },
 * 	]
 *
 * Endpoints is a legacy API and does not contain information about all Service
 * features. Use discoveryv1.EndpointSlice for complete information about Service
 * endpoints.
 *
 * Deprecated: This API is deprecated in v1.33+. Use discoveryv1.EndpointSlice.
 */
class Endpoints implements APIResourceInterface
{
    public const string API_VERSION = 'v1';
    public const string KIND = 'Endpoints';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * The set of all endpoints is the union of all subsets. Addresses are placed into
     * subsets according to the IPs they share. A single address with multiple ports,
     * some of which are ready and some of which are not (because they come from
     * different containers) will result in the address being displayed in different
     * subsets for the different ports. No address will appear in both Addresses and
     * NotReadyAddresses in the same subset. Sets of addresses and ports that comprise
     * a service.
     */
    private EndpointSubsetList $subsets;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->subsets = new EndpointSubsetList();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function subsets(): EndpointSubsetList
    {
        return $this->subsets;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'subsets' => $this->subsets,
        ];
    }
}
