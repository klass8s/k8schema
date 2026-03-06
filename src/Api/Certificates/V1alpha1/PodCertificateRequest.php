<?php

declare(strict_types=1);

namespace K8Schema\Api\Certificates\V1alpha1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;

/**
 * PodCertificateRequest encodes a pod requesting a certificate from a given
 * signer.
 *
 * Kubelets use this API to implement podCertificate projected volumes
 */
class PodCertificateRequest implements APIResourceInterface
{
    public const string API_VERSION = 'certificates.k8s.io/v1alpha1';
    public const string KIND = 'PodCertificateRequest';

    /**
     * metadata contains the object metadata.
     */
    private ObjectMeta $metadata;

    /**
     * spec contains the details about the certificate being requested.
     */
    private PodCertificateRequestSpec $spec;

    /**
     * status contains the issued certificate, and a standard set of conditions.
     */
    private PodCertificateRequestStatus|null $status = null;

    public function __construct(PodCertificateRequestSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): PodCertificateRequestSpec
    {
        return $this->spec;
    }

    public function getStatus(): PodCertificateRequestStatus|null
    {
        return $this->status;
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

    public function setSpec(PodCertificateRequestSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function setStatus(PodCertificateRequestStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function status(): PodCertificateRequestStatus
    {
        return $this->status ??= new PodCertificateRequestStatus();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
            'status' => $this->status,
        ]);
    }
}
