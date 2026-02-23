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

    public function getConfigMap(): ConfigMapProjection|null
    {
        return $this->configMap;
    }

    public function getDownwardAPI(): DownwardAPIProjection|null
    {
        return $this->downwardAPI;
    }

    public function getSecret(): SecretProjection|null
    {
        return $this->secret;
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

    public function setConfigMap(ConfigMapProjection $configMap): self
    {
        $this->configMap = $configMap;

        return $this;
    }

    public function setDownwardAPI(DownwardAPIProjection $downwardAPI): self
    {
        $this->downwardAPI = $downwardAPI;

        return $this;
    }

    public function setSecret(SecretProjection $secret): self
    {
        $this->secret = $secret;

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
            'secret' => $this->secret,
            'serviceAccountToken' => $this->serviceAccountToken,
        ]);
    }
}
