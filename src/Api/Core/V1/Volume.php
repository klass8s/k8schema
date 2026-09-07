<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * Volume represents a named volume in a pod that may be accessed by any container
 * in the pod.
 */
class Volume implements JsonSerializable
{
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
    private AzureFileVolumeSource|null $azureFile = null;

    /**
     * cephFS represents a Ceph FS mount on the host that shares a pod's lifetime.
     * Deprecated: CephFS is deprecated and the in-tree cephfs type is no longer
     * supported.
     */
    private CephFSVolumeSource|null $cephfs = null;

    /**
     * cinder represents a cinder volume attached and mounted on kubelets host machine.
     * Deprecated: Cinder is deprecated. All operations for the in-tree cinder type are
     * redirected to the cinder.csi.openstack.org CSI driver. More info:
     * https://examples.k8s.io/mysql-cinder-pd/README.md
     */
    private CinderVolumeSource|null $cinder = null;

    /**
     * configMap represents a configMap that should populate this volume
     */
    private ConfigMapVolumeSource|null $configMap = null;

    /**
     * csi (Container Storage Interface) represents ephemeral storage that is handled
     * by certain external CSI drivers.
     */
    private CSIVolumeSource|null $csi = null;

    /**
     * downwardAPI represents downward API about the pod that should populate this
     * volume
     */
    private DownwardAPIVolumeSource|null $downwardAPI = null;

    /**
     * emptyDir represents a temporary directory that shares a pod's lifetime. More
     * info: https://kubernetes.io/docs/concepts/storage/volumes#emptydir
     */
    private EmptyDirVolumeSource|null $emptyDir = null;

    /**
     * ephemeral represents a volume that is handled by a cluster storage driver. The
     * volume's lifecycle is tied to the pod that defines it - it will be created
     * before the pod starts, and deleted when the pod is removed.
     *
     * Use this if: a) the volume is only needed while the pod runs, b) features of
     * normal volumes like restoring from snapshot or capacity
     *    tracking are needed,
     * c) the storage driver is specified through a storage class, and d) the storage
     * driver supports dynamic volume provisioning through
     *    a PersistentVolumeClaim (see EphemeralVolumeSource for more
     *    information on the connection between this volume type
     *    and PersistentVolumeClaim).
     *
     * Use PersistentVolumeClaim or one of the vendor-specific APIs for volumes that
     * persist for longer than the lifecycle of an individual pod.
     *
     * Use CSI for light-weight local ephemeral volumes if the CSI driver is meant to
     * be used that way - see the documentation of the driver for more information.
     *
     * A pod can use both types of ephemeral volumes and persistent volumes at the same
     * time.
     */
    private EphemeralVolumeSource|null $ephemeral = null;

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
    private FlexVolumeSource|null $flexVolume = null;

    /**
     * flocker represents a Flocker volume attached to a kubelet's host machine. This
     * depends on the Flocker control service being running. Deprecated: Flocker is
     * deprecated and the in-tree flocker type is no longer supported.
     */
    private FlockerVolumeSource|null $flocker = null;

    /**
     * gcePersistentDisk represents a GCE Disk resource that is attached to a kubelet's
     * host machine and then exposed to the pod. Deprecated: GCEPersistentDisk is
     * deprecated. All operations for the in-tree gcePersistentDisk type are redirected
     * to the pd.csi.storage.gke.io CSI driver. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#gcepersistentdisk
     */
    private GCEPersistentDiskVolumeSource|null $gcePersistentDisk = null;

    /**
     * gitRepo represents a git repository at a particular revision. Deprecated:
     * GitRepo is deprecated. To provision a container with a git repo, mount an
     * EmptyDir into an InitContainer that clones the repo using git, then mount the
     * EmptyDir into the Pod's container.
     */
    private GitRepoVolumeSource|null $gitRepo = null;

    /**
     * glusterfs represents a Glusterfs mount on the host that shares a pod's lifetime.
     * Deprecated: Glusterfs is deprecated and the in-tree glusterfs type is no longer
     * supported.
     */
    private GlusterfsVolumeSource|null $glusterfs = null;

    /**
     * hostPath represents a pre-existing file or directory on the host machine that is
     * directly exposed to the container. This is generally used for system agents or
     * other privileged things that are allowed to see the host machine. Most
     * containers will NOT need this. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#hostpath
     */
    private HostPathVolumeSource|null $hostPath = null;

    /**
     * image represents an OCI object (a container image or artifact) pulled and
     * mounted on the kubelet's host machine. The volume is resolved at pod startup
     * depending on which PullPolicy value is provided:
     *
     * - Always: the kubelet always attempts to pull the reference. Container creation
     * will fail If the pull fails. - Never: the kubelet never pulls the reference and
     * only uses a local image or artifact. Container creation will fail if the
     * reference isn't present. - IfNotPresent: the kubelet pulls if the reference
     * isn't already present on disk. Container creation will fail if the reference
     * isn't present and the pull fails.
     *
     * The volume gets re-resolved if the pod gets deleted and recreated, which means
     * that new remote content will become available on pod recreation. A failure to
     * resolve or pull the image during pod startup will block containers from starting
     * and may add significant latency. Failures will be retried using normal volume
     * backoff and will be reported on the pod reason and message. The types of objects
     * that may be mounted by this volume are defined by the container runtime
     * implementation on a host machine and at minimum must include all valid types
     * supported by the container image field. The OCI object gets mounted in a single
     * directory (spec.containers[*].volumeMounts.mountPath) by merging the manifest
     * layers in the same way as for container images. The volume will be mounted
     * read-only (ro). Sub path mounts for containers are not supported
     * (spec.containers[*].volumeMounts.subpath) before 1.33. The field
     * spec.securityContext.fsGroupChangePolicy has no effect on this volume type.
     */
    private ImageVolumeSource|null $image = null;

    /**
     * iscsi represents an ISCSI Disk resource that is attached to a kubelet's host
     * machine and then exposed to the pod. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes/#iscsi
     */
    private ISCSIVolumeSource|null $iscsi = null;

    /**
     * name of the volume. Must be a DNS_LABEL and unique within the pod. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     */
    private string $name;

    /**
     * nfs represents an NFS mount on the host that shares a pod's lifetime More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#nfs
     */
    private NFSVolumeSource|null $nfs = null;

    /**
     * persistentVolumeClaimVolumeSource represents a reference to a
     * PersistentVolumeClaim in the same namespace. More info:
     * https://kubernetes.io/docs/concepts/storage/persistent-volumes#persistentvolumeclaims
     */
    private PersistentVolumeClaimVolumeSource|null $persistentVolumeClaim = null;

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
     * projected items for all in one resources secrets, configmaps, and downward API
     */
    private ProjectedVolumeSource|null $projected = null;

    /**
     * quobyte represents a Quobyte mount on the host that shares a pod's lifetime.
     * Deprecated: Quobyte is deprecated and the in-tree quobyte type is no longer
     * supported.
     */
    private QuobyteVolumeSource|null $quobyte = null;

    /**
     * rbd represents a Rados Block Device mount on the host that shares a pod's
     * lifetime. Deprecated: RBD is deprecated and the in-tree rbd type is no longer
     * supported.
     */
    private RBDVolumeSource|null $rbd = null;

    /**
     * scaleIO represents a ScaleIO persistent volume attached and mounted on
     * Kubernetes nodes. Deprecated: ScaleIO is deprecated and the in-tree scaleIO type
     * is no longer supported.
     */
    private ScaleIOVolumeSource|null $scaleIO = null;

    /**
     * secret represents a secret that should populate this volume. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#secret
     */
    private SecretVolumeSource|null $secret = null;

    /**
     * storageOS represents a StorageOS volume attached and mounted on Kubernetes
     * nodes. Deprecated: StorageOS is deprecated and the in-tree storageos type is no
     * longer supported.
     */
    private StorageOSVolumeSource|null $storageos = null;

    /**
     * vsphereVolume represents a vSphere volume attached and mounted on kubelets host
     * machine. Deprecated: VsphereVolume is deprecated. All operations for the in-tree
     * vsphereVolume type are redirected to the csi.vsphere.vmware.com CSI driver.
     */
    private VsphereVirtualDiskVolumeSource|null $vsphereVolume = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function cephfs(): CephFSVolumeSource
    {
        return $this->cephfs ??= new CephFSVolumeSource();
    }

    public function configMap(): ConfigMapVolumeSource
    {
        return $this->configMap ??= new ConfigMapVolumeSource();
    }

    public function downwardAPI(): DownwardAPIVolumeSource
    {
        return $this->downwardAPI ??= new DownwardAPIVolumeSource();
    }

    public function emptyDir(): EmptyDirVolumeSource
    {
        return $this->emptyDir ??= new EmptyDirVolumeSource();
    }

    public function ephemeral(): EphemeralVolumeSource
    {
        return $this->ephemeral ??= new EphemeralVolumeSource();
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

    public function getAzureFile(): AzureFileVolumeSource|null
    {
        return $this->azureFile;
    }

    public function getCephfs(): CephFSVolumeSource|null
    {
        return $this->cephfs;
    }

    public function getCinder(): CinderVolumeSource|null
    {
        return $this->cinder;
    }

    public function getConfigMap(): ConfigMapVolumeSource|null
    {
        return $this->configMap;
    }

    public function getCsi(): CSIVolumeSource|null
    {
        return $this->csi;
    }

    public function getDownwardAPI(): DownwardAPIVolumeSource|null
    {
        return $this->downwardAPI;
    }

    public function getEmptyDir(): EmptyDirVolumeSource|null
    {
        return $this->emptyDir;
    }

    public function getEphemeral(): EphemeralVolumeSource|null
    {
        return $this->ephemeral;
    }

    public function getFc(): FCVolumeSource|null
    {
        return $this->fc;
    }

    public function getFlexVolume(): FlexVolumeSource|null
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

    public function getGitRepo(): GitRepoVolumeSource|null
    {
        return $this->gitRepo;
    }

    public function getGlusterfs(): GlusterfsVolumeSource|null
    {
        return $this->glusterfs;
    }

    public function getHostPath(): HostPathVolumeSource|null
    {
        return $this->hostPath;
    }

    public function getImage(): ImageVolumeSource|null
    {
        return $this->image;
    }

    public function getIscsi(): ISCSIVolumeSource|null
    {
        return $this->iscsi;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNfs(): NFSVolumeSource|null
    {
        return $this->nfs;
    }

    public function getPersistentVolumeClaim(): PersistentVolumeClaimVolumeSource|null
    {
        return $this->persistentVolumeClaim;
    }

    public function getPhotonPersistentDisk(): PhotonPersistentDiskVolumeSource|null
    {
        return $this->photonPersistentDisk;
    }

    public function getPortworxVolume(): PortworxVolumeSource|null
    {
        return $this->portworxVolume;
    }

    public function getProjected(): ProjectedVolumeSource|null
    {
        return $this->projected;
    }

    public function getQuobyte(): QuobyteVolumeSource|null
    {
        return $this->quobyte;
    }

    public function getRbd(): RBDVolumeSource|null
    {
        return $this->rbd;
    }

    public function getScaleIO(): ScaleIOVolumeSource|null
    {
        return $this->scaleIO;
    }

    public function getSecret(): SecretVolumeSource|null
    {
        return $this->secret;
    }

    public function getStorageos(): StorageOSVolumeSource|null
    {
        return $this->storageos;
    }

    public function getVsphereVolume(): VsphereVirtualDiskVolumeSource|null
    {
        return $this->vsphereVolume;
    }

    public function image(): ImageVolumeSource
    {
        return $this->image ??= new ImageVolumeSource();
    }

    public function projected(): ProjectedVolumeSource
    {
        return $this->projected ??= new ProjectedVolumeSource();
    }

    public function secret(): SecretVolumeSource
    {
        return $this->secret ??= new SecretVolumeSource();
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

    public function setAzureFile(AzureFileVolumeSource $azureFile): self
    {
        $this->azureFile = $azureFile;

        return $this;
    }

    public function setCephfs(CephFSVolumeSource $cephfs): self
    {
        $this->cephfs = $cephfs;

        return $this;
    }

    public function setCinder(CinderVolumeSource $cinder): self
    {
        $this->cinder = $cinder;

        return $this;
    }

    public function setConfigMap(ConfigMapVolumeSource $configMap): self
    {
        $this->configMap = $configMap;

        return $this;
    }

    public function setCsi(CSIVolumeSource $csi): self
    {
        $this->csi = $csi;

        return $this;
    }

    public function setDownwardAPI(DownwardAPIVolumeSource $downwardAPI): self
    {
        $this->downwardAPI = $downwardAPI;

        return $this;
    }

    public function setEmptyDir(EmptyDirVolumeSource $emptyDir): self
    {
        $this->emptyDir = $emptyDir;

        return $this;
    }

    public function setEphemeral(EphemeralVolumeSource $ephemeral): self
    {
        $this->ephemeral = $ephemeral;

        return $this;
    }

    public function setFc(FCVolumeSource $fc): self
    {
        $this->fc = $fc;

        return $this;
    }

    public function setFlexVolume(FlexVolumeSource $flexVolume): self
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

    public function setGitRepo(GitRepoVolumeSource $gitRepo): self
    {
        $this->gitRepo = $gitRepo;

        return $this;
    }

    public function setGlusterfs(GlusterfsVolumeSource $glusterfs): self
    {
        $this->glusterfs = $glusterfs;

        return $this;
    }

    public function setHostPath(HostPathVolumeSource $hostPath): self
    {
        $this->hostPath = $hostPath;

        return $this;
    }

    public function setImage(ImageVolumeSource $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function setIscsi(ISCSIVolumeSource $iscsi): self
    {
        $this->iscsi = $iscsi;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setNfs(NFSVolumeSource $nfs): self
    {
        $this->nfs = $nfs;

        return $this;
    }

    public function setPersistentVolumeClaim(PersistentVolumeClaimVolumeSource $persistentVolumeClaim): self
    {
        $this->persistentVolumeClaim = $persistentVolumeClaim;

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

    public function setProjected(ProjectedVolumeSource $projected): self
    {
        $this->projected = $projected;

        return $this;
    }

    public function setQuobyte(QuobyteVolumeSource $quobyte): self
    {
        $this->quobyte = $quobyte;

        return $this;
    }

    public function setRbd(RBDVolumeSource $rbd): self
    {
        $this->rbd = $rbd;

        return $this;
    }

    public function setScaleIO(ScaleIOVolumeSource $scaleIO): self
    {
        $this->scaleIO = $scaleIO;

        return $this;
    }

    public function setSecret(SecretVolumeSource $secret): self
    {
        $this->secret = $secret;

        return $this;
    }

    public function setStorageos(StorageOSVolumeSource $storageos): self
    {
        $this->storageos = $storageos;

        return $this;
    }

    public function setVsphereVolume(VsphereVirtualDiskVolumeSource $vsphereVolume): self
    {
        $this->vsphereVolume = $vsphereVolume;

        return $this;
    }

    public function storageos(): StorageOSVolumeSource
    {
        return $this->storageos ??= new StorageOSVolumeSource();
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'awsElasticBlockStore' => $this->awsElasticBlockStore,
            'azureDisk' => $this->azureDisk,
            'azureFile' => $this->azureFile,
            'cephfs' => $this->cephfs,
            'cinder' => $this->cinder,
            'configMap' => $this->configMap,
            'csi' => $this->csi,
            'downwardAPI' => $this->downwardAPI,
            'emptyDir' => $this->emptyDir,
            'ephemeral' => $this->ephemeral,
            'fc' => $this->fc,
            'flexVolume' => $this->flexVolume,
            'flocker' => $this->flocker,
            'gcePersistentDisk' => $this->gcePersistentDisk,
            'gitRepo' => $this->gitRepo,
            'glusterfs' => $this->glusterfs,
            'hostPath' => $this->hostPath,
            'image' => $this->image,
            'iscsi' => $this->iscsi,
            'name' => $this->name,
            'nfs' => $this->nfs,
            'persistentVolumeClaim' => $this->persistentVolumeClaim,
            'photonPersistentDisk' => $this->photonPersistentDisk,
            'portworxVolume' => $this->portworxVolume,
            'projected' => $this->projected,
            'quobyte' => $this->quobyte,
            'rbd' => $this->rbd,
            'scaleIO' => $this->scaleIO,
            'secret' => $this->secret,
            'storageos' => $this->storageos,
            'vsphereVolume' => $this->vsphereVolume,
        ]);
    }
}
