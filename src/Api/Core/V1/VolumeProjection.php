<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * Projection that may be projected along with other supported volume types.
 * Exactly one of these fields must be set.
 */
class VolumeProjection implements JsonSerializable
{
    /**
     * ClusterTrustBundle allows a pod to access the `.spec.trustBundle` field of
     * ClusterTrustBundle objects in an auto-updating file.
     *
     * Alpha, gated by the ClusterTrustBundleProjection feature gate.
     *
     * ClusterTrustBundle objects can either be selected by name, or by the combination
     * of signer name and a label selector.
     *
     * Kubelet performs aggressive normalization of the PEM contents written into the
     * pod filesystem.  Esoteric PEM features such as inter-block comments and block
     * headers are stripped.  Certificates are deduplicated. The ordering of
     * certificates within the file is arbitrary, and Kubelet may change the order over
     * time.
     */
    private ClusterTrustBundleProjection|null $clusterTrustBundle = null;

    /**
     * configMap information about the configMap data to project
     */
    private ConfigMapProjection|null $configMap = null;

    /**
     * downwardAPI information about the downwardAPI data to project
     */
    private DownwardAPIProjection|null $downwardAPI = null;

    /**
     * Projects an auto-rotating credential bundle (private key and certificate chain)
     * that the pod can use either as a TLS client or server.
     *
     * Kubelet generates a private key and uses it to send a PodCertificateRequest to
     * the named signer.  Once the signer approves the request and issues a certificate
     * chain, Kubelet writes the key and certificate chain to the pod filesystem.  The
     * pod does not start until certificates have been issued for each podCertificate
     * projected volume source in its spec.
     *
     * Kubelet will begin trying to rotate the certificate at the time indicated by the
     * signer using the PodCertificateRequest.Status.BeginRefreshAt timestamp.
     *
     * Kubelet can write a single file, indicated by the credentialBundlePath field, or
     * separate files, indicated by the keyPath and certificateChainPath fields.
     *
     * The credential bundle is a single file in PEM format.  The first PEM entry is
     * the private key (in PKCS#8 format), and the remaining PEM entries are the
     * certificate chain issued by the signer (typically, signers will return their
     * certificate chain in leaf-to-root order).
     *
     * Prefer using the credential bundle format, since your application code can read
     * it atomically.  If you use keyPath and certificateChainPath, your application
     * must make two separate file reads. If these coincide with a certificate
     * rotation, it is possible that the private key and leaf certificate you read may
     * not correspond to each other.  Your application will need to check for this
     * condition, and re-read until they are consistent.
     *
     * The named signer controls chooses the format of the certificate it issues;
     * consult the signer implementation's documentation to learn how to use the
     * certificates it issues.
     */
    private PodCertificateProjection|null $podCertificate = null;

    /**
     * secret information about the secret data to project
     */
    private SecretProjection|null $secret = null;

    /**
     * serviceAccountToken is information about the serviceAccountToken data to project
     */
    private ServiceAccountTokenProjection|null $serviceAccountToken = null;

    public function __construct()
    {
    }

    public function configMap(): ConfigMapProjection
    {
        return $this->configMap ??= new ConfigMapProjection();
    }

    public function downwardAPI(): DownwardAPIProjection
    {
        return $this->downwardAPI ??= new DownwardAPIProjection();
    }

    public function getClusterTrustBundle(): ClusterTrustBundleProjection|null
    {
        return $this->clusterTrustBundle;
    }

    public function getPodCertificate(): PodCertificateProjection|null
    {
        return $this->podCertificate;
    }

    public function getServiceAccountToken(): ServiceAccountTokenProjection|null
    {
        return $this->serviceAccountToken;
    }

    public function secret(): SecretProjection
    {
        return $this->secret ??= new SecretProjection();
    }

    public function setClusterTrustBundle(ClusterTrustBundleProjection $clusterTrustBundle): self
    {
        $this->clusterTrustBundle = $clusterTrustBundle;

        return $this;
    }

    public function setPodCertificate(PodCertificateProjection $podCertificate): self
    {
        $this->podCertificate = $podCertificate;

        return $this;
    }

    public function setServiceAccountToken(ServiceAccountTokenProjection $serviceAccountToken): self
    {
        $this->serviceAccountToken = $serviceAccountToken;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'clusterTrustBundle' => $this->clusterTrustBundle,
            'configMap' => $this->configMap,
            'downwardAPI' => $this->downwardAPI,
            'podCertificate' => $this->podCertificate,
            'secret' => $this->secret,
            'serviceAccountToken' => $this->serviceAccountToken,
        ]);
    }
}
