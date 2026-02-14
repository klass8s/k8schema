<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * PodCertificateProjection provides a private key and X.509 certificate in the pod
 * filesystem.
 */
class PodCertificateProjection implements JsonSerializable
{
    /**
     * Write the certificate chain at this path in the projected volume.
     *
     * Most applications should use credentialBundlePath.  When using keyPath and
     * certificateChainPath, your application needs to check that the key and leaf
     * certificate are consistent, because it is possible to read the files
     * mid-rotation.
     */
    private string|null $certificateChainPath = null;

    /**
     * Write the credential bundle at this path in the projected volume.
     *
     * The credential bundle is a single file that contains multiple PEM blocks. The
     * first PEM block is a PRIVATE KEY block, containing a PKCS#8 private key.
     *
     * The remaining blocks are CERTIFICATE blocks, containing the issued certificate
     * chain from the signer (leaf and any intermediates).
     *
     * Using credentialBundlePath lets your Pod's application code make a single atomic
     * read that retrieves a consistent key and certificate chain.  If you project them
     * to separate files, your application code will need to additionally check that
     * the leaf certificate was issued to the key.
     */
    private string|null $credentialBundlePath = null;

    /**
     * Write the key at this path in the projected volume.
     *
     * Most applications should use credentialBundlePath.  When using keyPath and
     * certificateChainPath, your application needs to check that the key and leaf
     * certificate are consistent, because it is possible to read the files
     * mid-rotation.
     */
    private string|null $keyPath = null;

    /**
     * The type of keypair Kubelet will generate for the pod.
     *
     * Valid values are "RSA3072", "RSA4096", "ECDSAP256", "ECDSAP384", "ECDSAP521",
     * and "ED25519".
     */
    private string $keyType;

    /**
     * maxExpirationSeconds is the maximum lifetime permitted for the certificate.
     *
     * Kubelet copies this value verbatim into the PodCertificateRequests it generates
     * for this projection.
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
     * Kubelet's generated CSRs will be addressed to this signer.
     */
    private string $signerName;

    public function __construct(string $keyType, string $signerName)
    {
        $this->keyType = $keyType;
        $this->signerName = $signerName;
    }

    public function getCertificateChainPath(): string|null
    {
        return $this->certificateChainPath;
    }

    public function getCredentialBundlePath(): string|null
    {
        return $this->credentialBundlePath;
    }

    public function getKeyPath(): string|null
    {
        return $this->keyPath;
    }

    public function getKeyType(): string
    {
        return $this->keyType;
    }

    public function getMaxExpirationSeconds(): int|null
    {
        return $this->maxExpirationSeconds;
    }

    public function getSignerName(): string
    {
        return $this->signerName;
    }

    public function setCertificateChainPath(string $certificateChainPath): self
    {
        $this->certificateChainPath = $certificateChainPath;

        return $this;
    }

    public function setCredentialBundlePath(string $credentialBundlePath): self
    {
        $this->credentialBundlePath = $credentialBundlePath;

        return $this;
    }

    public function setKeyPath(string $keyPath): self
    {
        $this->keyPath = $keyPath;

        return $this;
    }

    public function setKeyType(string $keyType): self
    {
        $this->keyType = $keyType;

        return $this;
    }

    public function setMaxExpirationSeconds(int $maxExpirationSeconds): self
    {
        $this->maxExpirationSeconds = $maxExpirationSeconds;

        return $this;
    }

    public function setSignerName(string $signerName): self
    {
        $this->signerName = $signerName;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'certificateChainPath' => $this->certificateChainPath,
            'credentialBundlePath' => $this->credentialBundlePath,
            'keyPath' => $this->keyPath,
            'keyType' => $this->keyType,
            'maxExpirationSeconds' => $this->maxExpirationSeconds,
            'signerName' => $this->signerName,
        ]);
    }
}
