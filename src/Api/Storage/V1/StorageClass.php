<?php

declare(strict_types=1);

namespace K8Schema\Api\Storage\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Api\Core\V1\TopologySelectorTermList;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;
use K8Schema\Collection\StringList;
use K8Schema\Collection\StringMap;

/**
 * StorageClass describes the parameters for a class of storage for which
 * PersistentVolumes can be dynamically provisioned.
 *
 * StorageClasses are non-namespaced; the name of the storage class according to
 * etcd is in ObjectMeta.Name.
 */
class StorageClass implements APIResourceInterface
{
    public const string API_VERSION = 'storage.k8s.io/v1';
    public const string KIND = 'StorageClass';

    /**
     * allowVolumeExpansion shows whether the storage class allow volume expand.
     */
    private bool|null $allowVolumeExpansion = null;

    /**
     * allowedTopologies restrict the node topologies where volumes can be dynamically
     * provisioned. Each volume plugin defines its own supported topology
     * specifications. An empty TopologySelectorTerm list means there is no topology
     * restriction. This field is only honored by servers that enable the
     * VolumeScheduling feature.
     */
    private TopologySelectorTermList $allowedTopologies;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta|null $metadata = null;

    /**
     * mountOptions controls the mountOptions for dynamically provisioned
     * PersistentVolumes of this storage class. e.g. ["ro", "soft"]. Not validated -
     * mount of the PVs will simply fail if one is invalid.
     */
    private StringList $mountOptions;

    /**
     * parameters holds the parameters for the provisioner that should create volumes
     * of this storage class.
     */
    private StringMap $parameters;

    /**
     * provisioner indicates the type of the provisioner.
     */
    private string $provisioner;

    /**
     * reclaimPolicy controls the reclaimPolicy for dynamically provisioned
     * PersistentVolumes of this storage class. Defaults to Delete.
     */
    private string|null $reclaimPolicy = null;

    /**
     * volumeBindingMode indicates how PersistentVolumeClaims should be provisioned and
     * bound.  When unset, VolumeBindingImmediate is used. This field is only honored
     * by servers that enable the VolumeScheduling feature.
     */
    private string|null $volumeBindingMode = null;

    public function __construct(string $provisioner)
    {
        $this->allowedTopologies = new TopologySelectorTermList();
        $this->mountOptions = new StringList();
        $this->parameters = new StringMap();
        $this->provisioner = $provisioner;
    }

    public function allowedTopologies(): TopologySelectorTermList
    {
        return $this->allowedTopologies;
    }

    public function getAllowVolumeExpansion(): bool|null
    {
        return $this->allowVolumeExpansion;
    }

    public function getProvisioner(): string
    {
        return $this->provisioner;
    }

    public function getReclaimPolicy(): string|null
    {
        return $this->reclaimPolicy;
    }

    public function getVolumeBindingMode(): string|null
    {
        return $this->volumeBindingMode;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata ??= new ObjectMeta();
    }

    public function mountOptions(): StringList
    {
        return $this->mountOptions;
    }

    public function parameters(): StringMap
    {
        return $this->parameters;
    }

    public function setAllowVolumeExpansion(bool $allowVolumeExpansion): self
    {
        $this->allowVolumeExpansion = $allowVolumeExpansion;

        return $this;
    }

    public function setProvisioner(string $provisioner): self
    {
        $this->provisioner = $provisioner;

        return $this;
    }

    public function setReclaimPolicy(string $reclaimPolicy): self
    {
        $this->reclaimPolicy = $reclaimPolicy;

        return $this;
    }

    public function setVolumeBindingMode(string $volumeBindingMode): self
    {
        $this->volumeBindingMode = $volumeBindingMode;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'allowVolumeExpansion' => $this->allowVolumeExpansion,
            'allowedTopologies' => $this->allowedTopologies,
            'metadata' => $this->metadata,
            'mountOptions' => $this->mountOptions,
            'parameters' => $this->parameters,
            'provisioner' => $this->provisioner,
            'reclaimPolicy' => $this->reclaimPolicy,
            'volumeBindingMode' => $this->volumeBindingMode,
        ]);
    }
}
