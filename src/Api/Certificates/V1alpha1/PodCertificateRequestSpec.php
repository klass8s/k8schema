<?php

declare(strict_types=1);

namespace K8Schema\Api\Certificates\V1alpha1;

use JsonSerializable;

/**
 * PodCertificateRequestSpec describes the certificate request.  All fields are
 * immutable after creation.
 */
class PodCertificateRequestSpec implements JsonSerializable
{
    /**
     * maxExpirationSeconds is the maximum lifetime permitted for the certificate.
     *
     * If omitted, kube-apiserver will set it to 86400(24 hours). kube-apiserver will
     * reject values shorter than 3600 (1 hour).  The maximum allowable value is
     * 7862400 (91 days).
     *
     * The signer implementation is then free to issue a certificate with any lifetime
     * *shorter* than MaxExpirationSeconds, but no shorter than 3600 seconds (1 hour).
     * This constraint is enforced by kube-apiserver. `kubernetes.io` signers will
     * never issue certificates with a lifetime longer than 24 hours.
     */
    private int|null $maxExpirationSeconds = null;

    /**
     * nodeName is the name of the node the pod is assigned to.
     */
    private string $nodeName;

    /**
     * nodeUID is the UID of the node the pod is assigned to.
     */
    private string $nodeUID;

    /**
     * pkixPublicKey is the PKIX-serialized public key the signer will issue the
     * certificate to.
     *
     * The key must be one of RSA3072, RSA4096, ECDSAP256, ECDSAP384, ECDSAP521, or
     * ED25519. Note that this list may be expanded in the future.
     *
     * Signer implementations do not need to support all key types supported by
     * kube-apiserver and kubelet.  If a signer does not support the key type used for
     * a given PodCertificateRequest, it must deny the request by setting a
     * status.conditions entry with a type of "Denied" and a reason of
     * "UnsupportedKeyType". It may also suggest a key type that it does support in the
     * message field.
     */
    private string $pkixPublicKey;

    /**
     * podName is the name of the pod into which the certificate will be mounted.
     */
    private string $podName;

    /**
     * podUID is the UID of the pod into which the certificate will be mounted.
     */
    private string $podUID;

    /**
     * proofOfPossession proves that the requesting kubelet holds the private key
     * corresponding to pkixPublicKey.
     *
     * It is contructed by signing the ASCII bytes of the pod's UID using
     * `pkixPublicKey`.
     *
     * kube-apiserver validates the proof of possession during creation of the
     * PodCertificateRequest.
     *
     * If the key is an RSA key, then the signature is over the ASCII bytes of the pod
     * UID, using RSASSA-PSS from RFC 8017 (as implemented by the golang function
     * crypto/rsa.SignPSS with nil options).
     *
     * If the key is an ECDSA key, then the signature is as described by [SEC 1,
     * Version 2.0](https://www.secg.org/sec1-v2.pdf) (as implemented by the golang
     * library function crypto/ecdsa.SignASN1)
     *
     * If the key is an ED25519 key, the the signature is as described by the [ED25519
     * Specification](https://ed25519.cr.yp.to/) (as implemented by the golang library
     * crypto/ed25519.Sign).
     */
    private string $proofOfPossession;

    /**
     * serviceAccountName is the name of the service account the pod is running as.
     */
    private string $serviceAccountName;

    /**
     * serviceAccountUID is the UID of the service account the pod is running as.
     */
    private string $serviceAccountUID;

    /**
     * signerName indicates the requested signer.
     *
     * All signer names beginning with `kubernetes.io` are reserved for use by the
     * Kubernetes project.  There is currently one well-known signer documented by the
     * Kubernetes project, `kubernetes.io/kube-apiserver-client-pod`, which will issue
     * client certificates understood by kube-apiserver.  It is currently
     * unimplemented.
     */
    private string $signerName;

    public function __construct(
        string $nodeName,
        string $nodeUID,
        string $pkixPublicKey,
        string $podName,
        string $podUID,
        string $proofOfPossession,
        string $serviceAccountName,
        string $serviceAccountUID,
        string $signerName,
    ) {
        $this->nodeName = $nodeName;
        $this->nodeUID = $nodeUID;
        $this->pkixPublicKey = $pkixPublicKey;
        $this->podName = $podName;
        $this->podUID = $podUID;
        $this->proofOfPossession = $proofOfPossession;
        $this->serviceAccountName = $serviceAccountName;
        $this->serviceAccountUID = $serviceAccountUID;
        $this->signerName = $signerName;
    }

    public function getMaxExpirationSeconds(): int|null
    {
        return $this->maxExpirationSeconds;
    }

    public function getNodeName(): string
    {
        return $this->nodeName;
    }

    public function getNodeUID(): string
    {
        return $this->nodeUID;
    }

    public function getPkixPublicKey(): string
    {
        return $this->pkixPublicKey;
    }

    public function getPodName(): string
    {
        return $this->podName;
    }

    public function getPodUID(): string
    {
        return $this->podUID;
    }

    public function getProofOfPossession(): string
    {
        return $this->proofOfPossession;
    }

    public function getServiceAccountName(): string
    {
        return $this->serviceAccountName;
    }

    public function getServiceAccountUID(): string
    {
        return $this->serviceAccountUID;
    }

    public function getSignerName(): string
    {
        return $this->signerName;
    }

    public function setMaxExpirationSeconds(int $maxExpirationSeconds): self
    {
        $this->maxExpirationSeconds = $maxExpirationSeconds;

        return $this;
    }

    public function setNodeName(string $nodeName): self
    {
        $this->nodeName = $nodeName;

        return $this;
    }

    public function setNodeUID(string $nodeUID): self
    {
        $this->nodeUID = $nodeUID;

        return $this;
    }

    public function setPkixPublicKey(string $pkixPublicKey): self
    {
        $this->pkixPublicKey = $pkixPublicKey;

        return $this;
    }

    public function setPodName(string $podName): self
    {
        $this->podName = $podName;

        return $this;
    }

    public function setPodUID(string $podUID): self
    {
        $this->podUID = $podUID;

        return $this;
    }

    public function setProofOfPossession(string $proofOfPossession): self
    {
        $this->proofOfPossession = $proofOfPossession;

        return $this;
    }

    public function setServiceAccountName(string $serviceAccountName): self
    {
        $this->serviceAccountName = $serviceAccountName;

        return $this;
    }

    public function setServiceAccountUID(string $serviceAccountUID): self
    {
        $this->serviceAccountUID = $serviceAccountUID;

        return $this;
    }

    public function setSignerName(string $signerName): self
    {
        $this->signerName = $signerName;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'maxExpirationSeconds' => $this->maxExpirationSeconds,
            'nodeName' => $this->nodeName,
            'nodeUID' => $this->nodeUID,
            'pkixPublicKey' => $this->pkixPublicKey,
            'podName' => $this->podName,
            'podUID' => $this->podUID,
            'proofOfPossession' => $this->proofOfPossession,
            'serviceAccountName' => $this->serviceAccountName,
            'serviceAccountUID' => $this->serviceAccountUID,
            'signerName' => $this->signerName,
        ];
    }
}
