<?php

declare(strict_types=1);

namespace K8Schema\Api\Certificates\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * CertificateSigningRequest objects provide a mechanism to obtain x509
 * certificates by submitting a certificate signing request, and having it
 * asynchronously approved and issued.
 *
 * Kubelets use this API to obtain:
 *  1. client certificates to authenticate to kube-apiserver (with the
 * "kubernetes.io/kube-apiserver-client-kubelet" signerName).
 *  2. serving certificates for TLS endpoints kube-apiserver can connect to
 * securely (with the "kubernetes.io/kubelet-serving" signerName).
 *
 * This API can be used to request client certificates to authenticate to
 * kube-apiserver (with the "kubernetes.io/kube-apiserver-client" signerName), or
 * to obtain certificates from custom non-Kubernetes signers.
 */
class CertificateSigningRequest implements APIResourceInterface
{
    public const string API_VERSION = 'certificates.k8s.io/v1';
    public const string KIND = 'CertificateSigningRequest';

    private ObjectMeta $metadata;

    /**
     * spec contains the certificate request, and is immutable after creation. Only the
     * request, signerName, expirationSeconds, and usages fields can be set on
     * creation. Other fields are derived by Kubernetes and cannot be modified by
     * users.
     */
    private CertificateSigningRequestSpec $spec;

    public function __construct(CertificateSigningRequestSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): CertificateSigningRequestSpec
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

    public function setSpec(CertificateSigningRequestSpec $spec): self
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
