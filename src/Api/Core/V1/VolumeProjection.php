<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

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
    private ConfigMapProjection $configMap;

    /**
     * downwardAPI information about the downwardAPI data to project
     */
    private DownwardAPIProjection $downwardAPI;

    /**
     * secret information about the secret data to project
     */
    private SecretProjection $secret;

    /**
     * serviceAccountToken is information about the serviceAccountToken data to project
     */
    private ServiceAccountTokenProjection|null $serviceAccountToken = null;

    public function __construct()
    {
        $this->configMap = new ConfigMapProjection();
        $this->downwardAPI = new DownwardAPIProjection();
        $this->secret = new SecretProjection();
    }

    public function configMap(): ConfigMapProjection
    {
        return $this->configMap;
    }

    public function downwardAPI(): DownwardAPIProjection
    {
        return $this->downwardAPI;
    }

    public function getClusterTrustBundle(): ClusterTrustBundleProjection|null
    {
        return $this->clusterTrustBundle;
    }

    public function getServiceAccountToken(): ServiceAccountTokenProjection|null
    {
        return $this->serviceAccountToken;
    }

    public function secret(): SecretProjection
    {
        return $this->secret;
    }

    public function setClusterTrustBundle(ClusterTrustBundleProjection $clusterTrustBundle): self
    {
        $this->clusterTrustBundle = $clusterTrustBundle;

        return $this;
    }

    public function setServiceAccountToken(ServiceAccountTokenProjection $serviceAccountToken): self
    {
        $this->serviceAccountToken = $serviceAccountToken;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'clusterTrustBundle' => $this->clusterTrustBundle,
            'configMap' => $this->configMap,
            'downwardAPI' => $this->downwardAPI,
            'secret' => $this->secret,
            'serviceAccountToken' => $this->serviceAccountToken,
        ];
    }
}
