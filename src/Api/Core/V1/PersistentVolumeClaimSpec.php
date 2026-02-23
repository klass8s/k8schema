<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\LabelSelector;
use K8Schema\Collection\StringList;

/**
 * PersistentVolumeClaimSpec describes the common attributes of storage devices and
 * allows a Source for provider-specific attributes
 */
class PersistentVolumeClaimSpec implements JsonSerializable
{
    /**
     * accessModes contains the desired access modes the volume should have. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#access-modes-1
     */
    private StringList $accessModes;

    /**
     * dataSource field can be used to specify either: * An existing VolumeSnapshot
     * object (snapshot.storage.k8s.io/VolumeSnapshot) * An existing PVC
     * (PersistentVolumeClaim) If the provisioner or an external controller can support
     * the specified data source, it will create a new volume based on the contents of
     * the specified data source. When the AnyVolumeDataSource feature gate is enabled,
     * dataSource contents will be copied to dataSourceRef, and dataSourceRef contents
     * will be copied to dataSource when dataSourceRef.namespace is not specified. If
     * the namespace is specified, then dataSourceRef will not be copied to dataSource.
     */
    private TypedLocalObjectReference|null $dataSource = null;

    /**
     * dataSourceRef specifies the object from which to populate the volume with data,
     * if a non-empty volume is desired. This may be any object from a non-empty API
     * group (non core object) or a PersistentVolumeClaim object. When this field is
     * specified, volume binding will only succeed if the type of the specified object
     * matches some installed volume populator or dynamic provisioner. This field will
     * replace the functionality of the dataSource field and as such if both fields are
     * non-empty, they must have the same value. For backwards compatibility, when
     * namespace isn't specified in dataSourceRef, both fields (dataSource and
     * dataSourceRef) will be set to the same value automatically if one of them is
     * empty and the other is non-empty. When namespace is specified in dataSourceRef,
     * dataSource isn't set to the same value and must be empty. There are three
     * important differences between dataSource and dataSourceRef: * While dataSource
     * only allows two specific types of objects, dataSourceRef
     *   allows any non-core object, as well as PersistentVolumeClaim objects.
     * * While dataSource ignores disallowed values (dropping them), dataSourceRef
     *   preserves all values, and generates an error if a disallowed value is
     *   specified.
     * * While dataSource only allows local objects, dataSourceRef allows objects
     *   in any namespaces.
     * (Beta) Using this field requires the AnyVolumeDataSource feature gate to be
     * enabled. (Alpha) Using the namespace field of dataSourceRef requires the
     * CrossNamespaceVolumeDataSource feature gate to be enabled.
     */
    private TypedObjectReference|null $dataSourceRef = null;

    /**
     * resources represents the minimum resources the volume should have. If
     * RecoverVolumeExpansionFailure feature is enabled users are allowed to specify
     * resource requirements that are lower than previous value but must still be
     * higher than capacity recorded in the status field of the claim. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#resources
     */
    private VolumeResourceRequirements|null $resources = null;

    /**
     * selector is a label query over volumes to consider for binding.
     */
    private LabelSelector|null $selector = null;

    /**
     * storageClassName is the name of the StorageClass required by the claim. More
     * info: https://kubernetes.io/docs/concepts/storage/persistent-volumes#class-1
     */
    private string|null $storageClassName = null;

    /**
     * volumeAttributesClassName may be used to set the VolumeAttributesClass used by
     * this claim. If specified, the CSI driver will create or update the volume with
     * the attributes defined in the corresponding VolumeAttributesClass. This has a
     * different purpose than storageClassName, it can be changed after the claim is
     * created. An empty string or nil value indicates that no VolumeAttributesClass
     * will be applied to the claim. If the claim enters an Infeasible error state,
     * this field can be reset to its previous value (including nil) to cancel the
     * modification. If the resource referred to by volumeAttributesClass does not
     * exist, this PersistentVolumeClaim will be set to a Pending state, as reflected
     * by the modifyVolumeStatus field, until such as a resource exists. More info:
     * https://kubernetes.io/docs/concepts/storage/volume-attributes-classes/
     */
    private string|null $volumeAttributesClassName = null;

    /**
     * volumeMode defines what type of volume is required by the claim. Value of
     * Filesystem is implied when not included in claim spec.
     */
    private string|null $volumeMode = null;

    /**
     * volumeName is the binding reference to the PersistentVolume backing this claim.
     */
    private string|null $volumeName = null;

    public function __construct()
    {
        $this->accessModes = new StringList();
    }

    public function accessModes(): StringList
    {
        return $this->accessModes;
    }

    public function getDataSource(): TypedLocalObjectReference|null
    {
        return $this->dataSource;
    }

    public function getDataSourceRef(): TypedObjectReference|null
    {
        return $this->dataSourceRef;
    }

    public function getResources(): VolumeResourceRequirements|null
    {
        return $this->resources;
    }

    public function getSelector(): LabelSelector|null
    {
        return $this->selector;
    }

    public function getStorageClassName(): string|null
    {
        return $this->storageClassName;
    }

    public function getVolumeAttributesClassName(): string|null
    {
        return $this->volumeAttributesClassName;
    }

    public function getVolumeMode(): string|null
    {
        return $this->volumeMode;
    }

    public function getVolumeName(): string|null
    {
        return $this->volumeName;
    }

    public function resources(): VolumeResourceRequirements
    {
        return $this->resources ??= new VolumeResourceRequirements();
    }

    public function selector(): LabelSelector
    {
        return $this->selector ??= new LabelSelector();
    }

    public function setAccessModes(StringList $accessModes): self
    {
        $this->accessModes = $accessModes;

        return $this;
    }

    public function setDataSource(TypedLocalObjectReference $dataSource): self
    {
        $this->dataSource = $dataSource;

        return $this;
    }

    public function setDataSourceRef(TypedObjectReference $dataSourceRef): self
    {
        $this->dataSourceRef = $dataSourceRef;

        return $this;
    }

    public function setResources(VolumeResourceRequirements $resources): self
    {
        $this->resources = $resources;

        return $this;
    }

    public function setSelector(LabelSelector $selector): self
    {
        $this->selector = $selector;

        return $this;
    }

    public function setStorageClassName(string $storageClassName): self
    {
        $this->storageClassName = $storageClassName;

        return $this;
    }

    public function setVolumeAttributesClassName(string $volumeAttributesClassName): self
    {
        $this->volumeAttributesClassName = $volumeAttributesClassName;

        return $this;
    }

    public function setVolumeMode(string $volumeMode): self
    {
        $this->volumeMode = $volumeMode;

        return $this;
    }

    public function setVolumeName(string $volumeName): self
    {
        $this->volumeName = $volumeName;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'accessModes' => $this->accessModes,
            'dataSource' => $this->dataSource,
            'dataSourceRef' => $this->dataSourceRef,
            'resources' => $this->resources,
            'selector' => $this->selector,
            'storageClassName' => $this->storageClassName,
            'volumeAttributesClassName' => $this->volumeAttributesClassName,
            'volumeMode' => $this->volumeMode,
            'volumeName' => $this->volumeName,
        ]);
    }
}
