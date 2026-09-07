<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;
use K8Schema\Collection\StringOrFloatMap;

/**
 * PersistentVolumeSpec is the specification of a persistent volume.
 */
class PersistentVolumeSpec implements JsonSerializable
{
    /**
     * accessModes contains all ways the volume can be mounted. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#access-modes
     */
    private StringList $accessModes;

    /**
     * awsElasticBlockStore represents an AWS Disk resource that is attached to a
     * kubelet's host machine and then exposed to the pod. Deprecated:
     * AWSElasticBlockStore is deprecated. All operations for the in-tree
     * awsElasticBlockStore type are redirected to the ebs.csi.aws.com CSI driver. More
     * info: https://kubernetes.io/docs/concepts/storage/volumes#awselasticblockstore
     */
    private AWSElasticBlockStoreVolumeSource|null $awsElasticBlockStore = null;

    /**
     * azureDisk represents an Azure Data Disk mount on the host and bind mount to the
     * pod. Deprecated: AzureDisk is deprecated. All operations for the in-tree
     * azureDisk type are redirected to the disk.csi.azure.com CSI driver.
     */
    private AzureDiskVolumeSource|null $azureDisk = null;

    /**
     * azureFile represents an Azure File Service mount on the host and bind mount to
     * the pod. Deprecated: AzureFile is deprecated. All operations for the in-tree
     * azureFile type are redirected to the file.csi.azure.com CSI driver.
     */
    private AzureFilePersistentVolumeSource|null $azureFile = null;

    /**
     * capacity is the description of the persistent volume's resources and capacity.
     * More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#capacity
     */
    private StringOrFloatMap $capacity;

    /**
     * cephFS represents a Ceph FS mount on the host that shares a pod's lifetime.
     * Deprecated: CephFS is deprecated and the in-tree cephfs type is no longer
     * supported.
     */
    private CephFSPersistentVolumeSource|null $cephfs = null;

    /**
     * cinder represents a cinder volume attached and mounted on kubelets host machine.
     * Deprecated: Cinder is deprecated. All operations for the in-tree cinder type are
     * redirected to the cinder.csi.openstack.org CSI driver. More info:
     * https://examples.k8s.io/mysql-cinder-pd/README.md
     */
    private CinderPersistentVolumeSource|null $cinder = null;

    /**
     * claimRef is part of a bi-directional binding between PersistentVolume and
     * PersistentVolumeClaim. Expected to be non-nil when bound. claim.VolumeName is
     * the authoritative bind between PV and PVC. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#binding
     */
    private ObjectReference|null $claimRef = null;

    /**
     * csi represents storage that is handled by an external CSI driver.
     */
    private CSIPersistentVolumeSource|null $csi = null;

    /**
     * fc represents a Fibre Channel resource that is attached to a kubelet's host
     * machine and then exposed to the pod.
     */
    private FCVolumeSource|null $fc = null;

    /**
     * flexVolume represents a generic volume resource that is provisioned/attached
     * using an exec based plugin. Deprecated: FlexVolume is deprecated. Consider using
     * a CSIDriver instead.
     */
    private FlexPersistentVolumeSource|null $flexVolume = null;

    /**
     * flocker represents a Flocker volume attached to a kubelet's host machine and
     * exposed to the pod for its usage. This depends on the Flocker control service
     * being running. Deprecated: Flocker is deprecated and the in-tree flocker type is
     * no longer supported.
     */
    private FlockerVolumeSource|null $flocker = null;

    /**
     * gcePersistentDisk represents a GCE Disk resource that is attached to a kubelet's
     * host machine and then exposed to the pod. Provisioned by an admin. Deprecated:
     * GCEPersistentDisk is deprecated. All operations for the in-tree
     * gcePersistentDisk type are redirected to the pd.csi.storage.gke.io CSI driver.
     * More info: https://kubernetes.io/docs/concepts/storage/volumes#gcepersistentdisk
     */
    private GCEPersistentDiskVolumeSource|null $gcePersistentDisk = null;

    /**
     * glusterfs represents a Glusterfs volume that is attached to a host and exposed
     * to the pod. Provisioned by an admin. Deprecated: Glusterfs is deprecated and the
     * in-tree glusterfs type is no longer supported. More info:
     * https://examples.k8s.io/volumes/glusterfs/README.md
     */
    private GlusterfsPersistentVolumeSource|null $glusterfs = null;

    /**
     * hostPath represents a directory on the host. Provisioned by a developer or
     * tester. This is useful for single-node development and testing only! On-host
     * storage is not supported in any way and WILL NOT WORK in a multi-node cluster.
     * More info: https://kubernetes.io/docs/concepts/storage/volumes#hostpath
     */
    private HostPathVolumeSource|null $hostPath = null;

    /**
     * iscsi represents an ISCSI Disk resource that is attached to a kubelet's host
     * machine and then exposed to the pod. Provisioned by an admin.
     */
    private ISCSIPersistentVolumeSource|null $iscsi = null;

    /**
     * local represents directly-attached storage with node affinity
     */
    private LocalVolumeSource|null $local = null;

    /**
     * mountOptions is the list of mount options, e.g. ["ro", "soft"]. Not validated -
     * mount will simply fail if one is invalid. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes/#mount-options
     */
    private StringList $mountOptions;

    /**
     * nfs represents an NFS mount on the host. Provisioned by an admin. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#nfs
     */
    private NFSVolumeSource|null $nfs = null;

    /**
     * nodeAffinity defines constraints that limit what nodes this volume can be
     * accessed from. This field influences the scheduling of pods that use this
     * volume. This field is mutable if MutablePVNodeAffinity feature gate is enabled.
     */
    private VolumeNodeAffinity|null $nodeAffinity = null;

    /**
     * persistentVolumeReclaimPolicy defines what happens to a persistent volume when
     * released from its claim. Valid options are Retain (default for manually created
     * PersistentVolumes), Delete (default for dynamically provisioned
     * PersistentVolumes), and Recycle (deprecated). Recycle must be supported by the
     * volume plugin underlying this PersistentVolume. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#reclaiming
     */
    private string|null $persistentVolumeReclaimPolicy = null;

    /**
     * photonPersistentDisk represents a PhotonController persistent disk attached and
     * mounted on kubelets host machine. Deprecated: PhotonPersistentDisk is deprecated
     * and the in-tree photonPersistentDisk type is no longer supported.
     */
    private PhotonPersistentDiskVolumeSource|null $photonPersistentDisk = null;

    /**
     * portworxVolume represents a portworx volume attached and mounted on kubelets
     * host machine. Deprecated: PortworxVolume is deprecated. All operations for the
     * in-tree portworxVolume type are redirected to the pxd.portworx.com CSI driver.
     */
    private PortworxVolumeSource|null $portworxVolume = null;

    /**
     * quobyte represents a Quobyte mount on the host that shares a pod's lifetime.
     * Deprecated: Quobyte is deprecated and the in-tree quobyte type is no longer
     * supported.
     */
    private QuobyteVolumeSource|null $quobyte = null;

    /**
     * rbd represents a Rados Block Device mount on the host that shares a pod's
     * lifetime. Deprecated: RBD is deprecated and the in-tree rbd type is no longer
     * supported. More info: https://examples.k8s.io/volumes/rbd/README.md
     */
    private RBDPersistentVolumeSource|null $rbd = null;

    /**
     * scaleIO represents a ScaleIO persistent volume attached and mounted on
     * Kubernetes nodes. Deprecated: ScaleIO is deprecated and the in-tree scaleIO type
     * is no longer supported.
     */
    private ScaleIOPersistentVolumeSource|null $scaleIO = null;

    /**
     * storageClassName is the name of StorageClass to which this persistent volume
     * belongs. Empty value means that this volume does not belong to any StorageClass.
     */
    private string|null $storageClassName = null;

    /**
     * storageOS represents a StorageOS volume that is attached to the kubelet's host
     * machine and mounted into the pod. Deprecated: StorageOS is deprecated and the
     * in-tree storageos type is no longer supported. More info:
     * https://examples.k8s.io/volumes/storageos/README.md
     */
    private StorageOSPersistentVolumeSource|null $storageos = null;

    /**
     * Name of VolumeAttributesClass to which this persistent volume belongs. Empty
     * value is not allowed. When this field is not set, it indicates that this volume
     * does not belong to any VolumeAttributesClass. This field is mutable and can be
     * changed by the CSI driver after a volume has been updated successfully to a new
     * class. For an unbound PersistentVolume, the volumeAttributesClassName will be
     * matched with unbound PersistentVolumeClaims during the binding process.
     */
    private string|null $volumeAttributesClassName = null;

    /**
     * volumeMode defines if a volume is intended to be used with a formatted
     * filesystem or to remain in raw block state. Value of Filesystem is implied when
     * not included in spec.
     */
    private string|null $volumeMode = null;

    /**
     * vsphereVolume represents a vSphere volume attached and mounted on kubelets host
     * machine. Deprecated: VsphereVolume is deprecated. All operations for the in-tree
     * vsphereVolume type are redirected to the csi.vsphere.vmware.com CSI driver.
     */
    private VsphereVirtualDiskVolumeSource|null $vsphereVolume = null;

    public function __construct()
    {
        $this->accessModes = new StringList();
        $this->capacity = new StringOrFloatMap();
        $this->mountOptions = new StringList();
    }

    public function accessModes(): StringList
    {
        return $this->accessModes;
    }

    public function capacity(): StringOrFloatMap
    {
        return $this->capacity;
    }

    public function cephfs(): CephFSPersistentVolumeSource
    {
        return $this->cephfs ??= new CephFSPersistentVolumeSource();
    }

    public function claimRef(): ObjectReference
    {
        return $this->claimRef ??= new ObjectReference();
    }

    public function fc(): FCVolumeSource
    {
        return $this->fc ??= new FCVolumeSource();
    }

    public function flocker(): FlockerVolumeSource
    {
        return $this->flocker ??= new FlockerVolumeSource();
    }

    public function getAwsElasticBlockStore(): AWSElasticBlockStoreVolumeSource|null
    {
        return $this->awsElasticBlockStore;
    }

    public function getAzureDisk(): AzureDiskVolumeSource|null
    {
        return $this->azureDisk;
    }

    public function getAzureFile(): AzureFilePersistentVolumeSource|null
    {
        return $this->azureFile;
    }

    public function getCephfs(): CephFSPersistentVolumeSource|null
    {
        return $this->cephfs;
    }

    public function getCinder(): CinderPersistentVolumeSource|null
    {
        return $this->cinder;
    }

    public function getClaimRef(): ObjectReference|null
    {
        return $this->claimRef;
    }

    public function getCsi(): CSIPersistentVolumeSource|null
    {
        return $this->csi;
    }

    public function getFc(): FCVolumeSource|null
    {
        return $this->fc;
    }

    public function getFlexVolume(): FlexPersistentVolumeSource|null
    {
        return $this->flexVolume;
    }

    public function getFlocker(): FlockerVolumeSource|null
    {
        return $this->flocker;
    }

    public function getGcePersistentDisk(): GCEPersistentDiskVolumeSource|null
    {
        return $this->gcePersistentDisk;
    }

    public function getGlusterfs(): GlusterfsPersistentVolumeSource|null
    {
        return $this->glusterfs;
    }

    public function getHostPath(): HostPathVolumeSource|null
    {
        return $this->hostPath;
    }

    public function getIscsi(): ISCSIPersistentVolumeSource|null
    {
        return $this->iscsi;
    }

    public function getLocal(): LocalVolumeSource|null
    {
        return $this->local;
    }

    public function getNfs(): NFSVolumeSource|null
    {
        return $this->nfs;
    }

    public function getNodeAffinity(): VolumeNodeAffinity|null
    {
        return $this->nodeAffinity;
    }

    public function getPersistentVolumeReclaimPolicy(): string|null
    {
        return $this->persistentVolumeReclaimPolicy;
    }

    public function getPhotonPersistentDisk(): PhotonPersistentDiskVolumeSource|null
    {
        return $this->photonPersistentDisk;
    }

    public function getPortworxVolume(): PortworxVolumeSource|null
    {
        return $this->portworxVolume;
    }

    public function getQuobyte(): QuobyteVolumeSource|null
    {
        return $this->quobyte;
    }

    public function getRbd(): RBDPersistentVolumeSource|null
    {
        return $this->rbd;
    }

    public function getScaleIO(): ScaleIOPersistentVolumeSource|null
    {
        return $this->scaleIO;
    }

    public function getStorageClassName(): string|null
    {
        return $this->storageClassName;
    }

    public function getStorageos(): StorageOSPersistentVolumeSource|null
    {
        return $this->storageos;
    }

    public function getVolumeAttributesClassName(): string|null
    {
        return $this->volumeAttributesClassName;
    }

    public function getVolumeMode(): string|null
    {
        return $this->volumeMode;
    }

    public function getVsphereVolume(): VsphereVirtualDiskVolumeSource|null
    {
        return $this->vsphereVolume;
    }

    public function mountOptions(): StringList
    {
        return $this->mountOptions;
    }

    public function nodeAffinity(): VolumeNodeAffinity
    {
        return $this->nodeAffinity ??= new VolumeNodeAffinity();
    }

    public function setAccessModes(StringList $accessModes): self
    {
        $this->accessModes = $accessModes;

        return $this;
    }

    public function setAwsElasticBlockStore(AWSElasticBlockStoreVolumeSource $awsElasticBlockStore): self
    {
        $this->awsElasticBlockStore = $awsElasticBlockStore;

        return $this;
    }

    public function setAzureDisk(AzureDiskVolumeSource $azureDisk): self
    {
        $this->azureDisk = $azureDisk;

        return $this;
    }

    public function setAzureFile(AzureFilePersistentVolumeSource $azureFile): self
    {
        $this->azureFile = $azureFile;

        return $this;
    }

    public function setCapacity(StringOrFloatMap $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function setCephfs(CephFSPersistentVolumeSource $cephfs): self
    {
        $this->cephfs = $cephfs;

        return $this;
    }

    public function setCinder(CinderPersistentVolumeSource $cinder): self
    {
        $this->cinder = $cinder;

        return $this;
    }

    public function setClaimRef(ObjectReference $claimRef): self
    {
        $this->claimRef = $claimRef;

        return $this;
    }

    public function setCsi(CSIPersistentVolumeSource $csi): self
    {
        $this->csi = $csi;

        return $this;
    }

    public function setFc(FCVolumeSource $fc): self
    {
        $this->fc = $fc;

        return $this;
    }

    public function setFlexVolume(FlexPersistentVolumeSource $flexVolume): self
    {
        $this->flexVolume = $flexVolume;

        return $this;
    }

    public function setFlocker(FlockerVolumeSource $flocker): self
    {
        $this->flocker = $flocker;

        return $this;
    }

    public function setGcePersistentDisk(GCEPersistentDiskVolumeSource $gcePersistentDisk): self
    {
        $this->gcePersistentDisk = $gcePersistentDisk;

        return $this;
    }

    public function setGlusterfs(GlusterfsPersistentVolumeSource $glusterfs): self
    {
        $this->glusterfs = $glusterfs;

        return $this;
    }

    public function setHostPath(HostPathVolumeSource $hostPath): self
    {
        $this->hostPath = $hostPath;

        return $this;
    }

    public function setIscsi(ISCSIPersistentVolumeSource $iscsi): self
    {
        $this->iscsi = $iscsi;

        return $this;
    }

    public function setLocal(LocalVolumeSource $local): self
    {
        $this->local = $local;

        return $this;
    }

    public function setMountOptions(StringList $mountOptions): self
    {
        $this->mountOptions = $mountOptions;

        return $this;
    }

    public function setNfs(NFSVolumeSource $nfs): self
    {
        $this->nfs = $nfs;

        return $this;
    }

    public function setNodeAffinity(VolumeNodeAffinity $nodeAffinity): self
    {
        $this->nodeAffinity = $nodeAffinity;

        return $this;
    }

    public function setPersistentVolumeReclaimPolicy(string $persistentVolumeReclaimPolicy): self
    {
        $this->persistentVolumeReclaimPolicy = $persistentVolumeReclaimPolicy;

        return $this;
    }

    public function setPhotonPersistentDisk(PhotonPersistentDiskVolumeSource $photonPersistentDisk): self
    {
        $this->photonPersistentDisk = $photonPersistentDisk;

        return $this;
    }

    public function setPortworxVolume(PortworxVolumeSource $portworxVolume): self
    {
        $this->portworxVolume = $portworxVolume;

        return $this;
    }

    public function setQuobyte(QuobyteVolumeSource $quobyte): self
    {
        $this->quobyte = $quobyte;

        return $this;
    }

    public function setRbd(RBDPersistentVolumeSource $rbd): self
    {
        $this->rbd = $rbd;

        return $this;
    }

    public function setScaleIO(ScaleIOPersistentVolumeSource $scaleIO): self
    {
        $this->scaleIO = $scaleIO;

        return $this;
    }

    public function setStorageClassName(string $storageClassName): self
    {
        $this->storageClassName = $storageClassName;

        return $this;
    }

    public function setStorageos(StorageOSPersistentVolumeSource $storageos): self
    {
        $this->storageos = $storageos;

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

    public function setVsphereVolume(VsphereVirtualDiskVolumeSource $vsphereVolume): self
    {
        $this->vsphereVolume = $vsphereVolume;

        return $this;
    }

    public function storageos(): StorageOSPersistentVolumeSource
    {
        return $this->storageos ??= new StorageOSPersistentVolumeSource();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'accessModes' => $this->accessModes,
            'awsElasticBlockStore' => $this->awsElasticBlockStore,
            'azureDisk' => $this->azureDisk,
            'azureFile' => $this->azureFile,
            'capacity' => $this->capacity,
            'cephfs' => $this->cephfs,
            'cinder' => $this->cinder,
            'claimRef' => $this->claimRef,
            'csi' => $this->csi,
            'fc' => $this->fc,
            'flexVolume' => $this->flexVolume,
            'flocker' => $this->flocker,
            'gcePersistentDisk' => $this->gcePersistentDisk,
            'glusterfs' => $this->glusterfs,
            'hostPath' => $this->hostPath,
            'iscsi' => $this->iscsi,
            'local' => $this->local,
            'mountOptions' => $this->mountOptions,
            'nfs' => $this->nfs,
            'nodeAffinity' => $this->nodeAffinity,
            'persistentVolumeReclaimPolicy' => $this->persistentVolumeReclaimPolicy,
            'photonPersistentDisk' => $this->photonPersistentDisk,
            'portworxVolume' => $this->portworxVolume,
            'quobyte' => $this->quobyte,
            'rbd' => $this->rbd,
            'scaleIO' => $this->scaleIO,
            'storageClassName' => $this->storageClassName,
            'storageos' => $this->storageos,
            'volumeAttributesClassName' => $this->volumeAttributesClassName,
            'volumeMode' => $this->volumeMode,
            'vsphereVolume' => $this->vsphereVolume,
        ]);
    }
}
