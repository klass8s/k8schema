<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringOrFloatMap;

/**
 * ContainerStatus contains details for the current status of this container.
 */
class ContainerStatus implements JsonSerializable
{
    /**
     * AllocatedResources represents the compute resources allocated for this container
     * by the node. Kubelet sets this value to Container.Resources.Requests upon
     * successful pod admission and after successfully admitting desired pod resize.
     */
    private StringOrFloatMap $allocatedResources;

    /**
     * AllocatedResourcesStatus represents the status of various resources allocated
     * for this Pod.
     */
    private ResourceStatusList $allocatedResourcesStatus;

    /**
     * ContainerID is the ID of the container in the format '<type>://<container_id>'.
     * Where type is a container runtime identifier, returned from Version call of CRI
     * API (for example "containerd").
     */
    private string|null $containerID = null;

    /**
     * Image is the name of container image that the container is running. The
     * container image may not match the image used in the PodSpec, as it may have been
     * resolved by the runtime. More info:
     * https://kubernetes.io/docs/concepts/containers/images.
     */
    private string $image;

    /**
     * ImageID is the image ID of the container's image. The image ID may not match the
     * image ID of the image used in the PodSpec, as it may have been resolved by the
     * runtime.
     */
    private string $imageID;

    /**
     * LastTerminationState holds the last termination state of the container to help
     * debug container crashes and restarts. This field is not populated if the
     * container is still running and RestartCount is 0.
     */
    private ContainerState|null $lastState = null;

    /**
     * Name is a DNS_LABEL representing the unique name of the container. Each
     * container in a pod must have a unique name across all container types. Cannot be
     * updated.
     */
    private string $name;

    /**
     * Ready specifies whether the container is currently passing its readiness check.
     * The value will change as readiness probes keep executing. If no readiness probes
     * are specified, this field defaults to true once the container is fully started
     * (see Started field).
     *
     * The value is typically used to determine whether a container is ready to accept
     * traffic.
     */
    private bool $ready;

    /**
     * Resources represents the compute resource requests and limits that have been
     * successfully enacted on the running container after it has been started or has
     * been successfully resized.
     */
    private ResourceRequirements|null $resources = null;

    /**
     * RestartCount holds the number of times the container has been restarted. Kubelet
     * makes an effort to always increment the value, but there are cases when the
     * state may be lost due to node restarts and then the value may be reset to 0. The
     * value is never negative.
     */
    private int $restartCount;

    /**
     * Started indicates whether the container has finished its postStart lifecycle
     * hook and passed its startup probe. Initialized as false, becomes true after
     * startupProbe is considered successful. Resets to false when the container is
     * restarted, or if kubelet loses state temporarily. In both cases, startup probes
     * will run again. Is always true when no startupProbe is defined and container is
     * running and has passed the postStart lifecycle hook. The null value must be
     * treated the same as false.
     */
    private bool|null $started = null;

    /**
     * State holds details about the container's current condition.
     */
    private ContainerState|null $state = null;

    /**
     * StopSignal reports the effective stop signal for this container
     */
    private string|null $stopSignal = null;

    /**
     * User represents user identity information initially attached to the first
     * process of the container
     */
    private ContainerUser|null $user = null;

    /**
     * Status of volume mounts.
     */
    private VolumeMountStatusList $volumeMounts;

    public function __construct(string $image, string $imageID, string $name, bool $ready, int $restartCount)
    {
        $this->allocatedResources = new StringOrFloatMap();
        $this->allocatedResourcesStatus = new ResourceStatusList();
        $this->image = $image;
        $this->imageID = $imageID;
        $this->name = $name;
        $this->ready = $ready;
        $this->restartCount = $restartCount;
        $this->volumeMounts = new VolumeMountStatusList();
    }

    public function allocatedResources(): StringOrFloatMap
    {
        return $this->allocatedResources;
    }

    public function allocatedResourcesStatus(): ResourceStatusList
    {
        return $this->allocatedResourcesStatus;
    }

    public function getContainerID(): string|null
    {
        return $this->containerID;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getImageID(): string
    {
        return $this->imageID;
    }

    public function getLastState(): ContainerState|null
    {
        return $this->lastState;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getReady(): bool
    {
        return $this->ready;
    }

    public function getResources(): ResourceRequirements|null
    {
        return $this->resources;
    }

    public function getRestartCount(): int
    {
        return $this->restartCount;
    }

    public function getStarted(): bool|null
    {
        return $this->started;
    }

    public function getState(): ContainerState|null
    {
        return $this->state;
    }

    public function getStopSignal(): string|null
    {
        return $this->stopSignal;
    }

    public function getUser(): ContainerUser|null
    {
        return $this->user;
    }

    public function lastState(): ContainerState
    {
        return $this->lastState ??= new ContainerState();
    }

    public function resources(): ResourceRequirements
    {
        return $this->resources ??= new ResourceRequirements();
    }

    public function setAllocatedResources(StringOrFloatMap $allocatedResources): self
    {
        $this->allocatedResources = $allocatedResources;

        return $this;
    }

    public function setAllocatedResourcesStatus(ResourceStatusList $allocatedResourcesStatus): self
    {
        $this->allocatedResourcesStatus = $allocatedResourcesStatus;

        return $this;
    }

    public function setContainerID(string $containerID): self
    {
        $this->containerID = $containerID;

        return $this;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function setImageID(string $imageID): self
    {
        $this->imageID = $imageID;

        return $this;
    }

    public function setLastState(ContainerState $lastState): self
    {
        $this->lastState = $lastState;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setReady(bool $ready): self
    {
        $this->ready = $ready;

        return $this;
    }

    public function setResources(ResourceRequirements $resources): self
    {
        $this->resources = $resources;

        return $this;
    }

    public function setRestartCount(int $restartCount): self
    {
        $this->restartCount = $restartCount;

        return $this;
    }

    public function setStarted(bool $started): self
    {
        $this->started = $started;

        return $this;
    }

    public function setState(ContainerState $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function setStopSignal(string $stopSignal): self
    {
        $this->stopSignal = $stopSignal;

        return $this;
    }

    public function setUser(ContainerUser $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function setVolumeMounts(VolumeMountStatusList $volumeMounts): self
    {
        $this->volumeMounts = $volumeMounts;

        return $this;
    }

    public function state(): ContainerState
    {
        return $this->state ??= new ContainerState();
    }

    public function user(): ContainerUser
    {
        return $this->user ??= new ContainerUser();
    }

    public function volumeMounts(): VolumeMountStatusList
    {
        return $this->volumeMounts;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'allocatedResources' => $this->allocatedResources,
            'allocatedResourcesStatus' => $this->allocatedResourcesStatus,
            'containerID' => $this->containerID,
            'image' => $this->image,
            'imageID' => $this->imageID,
            'lastState' => $this->lastState,
            'name' => $this->name,
            'ready' => $this->ready,
            'resources' => $this->resources,
            'restartCount' => $this->restartCount,
            'started' => $this->started,
            'state' => $this->state,
            'stopSignal' => $this->stopSignal,
            'user' => $this->user,
            'volumeMounts' => $this->volumeMounts,
        ]);
    }
}
