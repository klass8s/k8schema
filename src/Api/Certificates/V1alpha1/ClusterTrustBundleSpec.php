<?php

declare(strict_types=1);

namespace K8Schema\Api\Certificates\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * ClusterTrustBundleSpec contains the signer and trust anchors.
 */
class ClusterTrustBundleSpec implements JsonSerializable
{
    /**
     * signerName indicates the associated signer, if any.
     *
     * In order to create or update a ClusterTrustBundle that sets signerName, you must
     * have the following cluster-scoped permission: group=certificates.k8s.io
     * resource=signers resourceName=<the signer name> verb=attest.
     *
     * If signerName is not empty, then the ClusterTrustBundle object must be named
     * with the signer name as a prefix (translating slashes to colons). For example,
     * for the signer name `example.com/foo`, valid ClusterTrustBundle object names
     * include `example.com:foo:abc` and `example.com:foo:v1`.
     *
     * If signerName is empty, then the ClusterTrustBundle object's name must not have
     * such a prefix.
     *
     * List/watch requests for ClusterTrustBundles can filter on this field using a
     * `spec.signerName=NAME` field selector.
     */
    private string|null $signerName = null;

    /**
     * trustBundle contains the individual X.509 trust anchors for this bundle, as PEM
     * bundle of PEM-wrapped, DER-formatted X.509 certificates.
     *
     * The data must consist only of PEM certificate blocks that parse as valid X.509
     * certificates.  Each certificate must include a basic constraints extension with
     * the CA bit set.  The API server will reject objects that contain duplicate
     * certificates, or that use PEM block headers.
     *
     * Users of ClusterTrustBundles, including Kubelet, are free to reorder and
     * deduplicate certificate blocks in this file according to their own logic, as
     * well as to drop PEM block headers and inter-block data.
     */
    private string $trustBundle;

    public function __construct(string $trustBundle)
    {
        $this->trustBundle = $trustBundle;
    }

    public function getSignerName(): string|null
    {
        return $this->signerName;
    }

    public function getTrustBundle(): string
    {
        return $this->trustBundle;
    }

    public function setSignerName(string $signerName): self
    {
        $this->signerName = $signerName;

        return $this;
    }

    public function setTrustBundle(string $trustBundle): self
    {
        $this->trustBundle = $trustBundle;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'signerName' => $this->signerName,
            'trustBundle' => $this->trustBundle,
        ]);
    }
}
