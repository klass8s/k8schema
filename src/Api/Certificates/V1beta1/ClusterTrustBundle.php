<?php

declare(strict_types=1);

namespace K8Schema\Api\Certificates\V1beta1;

use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * ClusterTrustBundle is a cluster-scoped container for X.509 trust anchors (root
 * certificates).
 *
 * ClusterTrustBundle objects are considered to be readable by any authenticated
 * user in the cluster, because they can be mounted by pods using the
 * `clusterTrustBundle` projection.  All service accounts have read access to
 * ClusterTrustBundles by default.  Users who only have namespace-level access to a
 * cluster can read ClusterTrustBundles by impersonating a serviceaccount that they
 * have access to.
 *
 * It can be optionally associated with a particular assigner, in which case it
 * contains one valid set of trust anchors for that signer. Signers may have
 * multiple associated ClusterTrustBundles; each is an independent set of trust
 * anchors for that signer. Admission control is used to enforce that only users
 * with permissions on the signer can create or modify the corresponding bundle.
 */
class ClusterTrustBundle implements APIResourceInterface
{
    public const string API_VERSION = 'certificates.k8s.io/v1beta1';
    public const string KIND = 'ClusterTrustBundle';

    /**
     * metadata contains the object metadata.
     */
    private ObjectMeta $metadata;

    /**
     * spec contains the signer (if any) and trust anchors.
     */
    private ClusterTrustBundleSpec $spec;

    public function __construct(ClusterTrustBundleSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): ClusterTrustBundleSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(ClusterTrustBundleSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
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
