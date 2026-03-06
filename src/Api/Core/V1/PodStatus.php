<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * PodStatus represents information about the status of a pod. Status may trail the
 * actual state of a system, especially if the node that hosts the pod cannot
 * contact the control plane.
 */
class PodStatus implements JsonSerializable
{
    /**
     * Current service state of pod. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#pod-conditions
     */
    private PodConditionList $conditions;

    /**
     * Statuses of containers in this pod. Each container in the pod should have at
     * most one status in this list, and all statuses should be for containers in the
     * pod. However this is not enforced. If a status for a non-existent container is
     * present in the list, or the list has duplicate names, the behavior of various
     * Kubernetes components is not defined and those statuses might be ignored. More
     * info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#pod-and-container-status
     */
    private ContainerStatusList $containerStatuses;

    /**
     * Statuses for any ephemeral containers that have run in this pod. Each ephemeral
     * container in the pod should have at most one status in this list, and all
     * statuses should be for containers in the pod. However this is not enforced. If a
     * status for a non-existent container is present in the list, or the list has
     * duplicate names, the behavior of various Kubernetes components is not defined
     * and those statuses might be ignored. More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#pod-and-container-status
     */
    private ContainerStatusList $ephemeralContainerStatuses;

    /**
     * Status of extended resource claim backed by DRA.
     */
    private PodExtendedResourceClaimStatus|null $extendedResourceClaimStatus = null;

    /**
     * hostIP holds the IP address of the host to which the pod is assigned. Empty if
     * the pod has not started yet. A pod can be assigned to a node that has a problem
     * in kubelet which in turns mean that HostIP will not be updated even if there is
     * a node is assigned to pod
     */
    private string|null $hostIP = null;

    /**
     * hostIPs holds the IP addresses allocated to the host. If this field is
     * specified, the first entry must match the hostIP field. This list is empty if
     * the pod has not started yet. A pod can be assigned to a node that has a problem
     * in kubelet which in turns means that HostIPs will not be updated even if there
     * is a node is assigned to this pod.
     */
    private HostIPList $hostIPs;

    /**
     * Statuses of init containers in this pod. The most recent successful
     * non-restartable init container will have ready = true, the most recently started
     * container will have startTime set. Each init container in the pod should have at
     * most one status in this list, and all statuses should be for containers in the
     * pod. However this is not enforced. If a status for a non-existent container is
     * present in the list, or the list has duplicate names, the behavior of various
     * Kubernetes components is not defined and those statuses might be ignored. More
     * info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle/#pod-and-container-status
     */
    private ContainerStatusList $initContainerStatuses;

    /**
     * A human readable message indicating details about why the pod is in this
     * condition.
     */
    private string|null $message = null;

    /**
     * nominatedNodeName is set only when this pod preempts other pods on the node, but
     * it cannot be scheduled right away as preemption victims receive their graceful
     * termination periods. This field does not guarantee that the pod will be
     * scheduled on this node. Scheduler may decide to place the pod elsewhere if other
     * nodes become available sooner. Scheduler may also decide to give the resources
     * on this node to a higher priority pod that is created after preemption. As a
     * result, this field may be different than PodSpec.nodeName when the pod is
     * scheduled.
     */
    private string|null $nominatedNodeName = null;

    /**
     * If set, this represents the .metadata.generation that the pod status was set
     * based upon. This is an alpha field. Enable PodObservedGenerationTracking to be
     * able to use this field.
     */
    private int|null $observedGeneration = null;

    /**
     * The phase of a Pod is a simple, high-level summary of where the Pod is in its
     * lifecycle. The conditions array, the reason and message fields, and the
     * individual container status arrays contain more detail about the pod's status.
     * There are five possible phase values:
     *
     * Pending: The pod has been accepted by the Kubernetes system, but one or more of
     * the container images has not been created. This includes time before being
     * scheduled as well as time spent downloading images over the network, which could
     * take a while. Running: The pod has been bound to a node, and all of the
     * containers have been created. At least one container is still running, or is in
     * the process of starting or restarting. Succeeded: All containers in the pod have
     * terminated in success, and will not be restarted. Failed: All containers in the
     * pod have terminated, and at least one container has terminated in failure. The
     * container either exited with non-zero status or was terminated by the system.
     * Unknown: For some reason the state of the pod could not be obtained, typically
     * due to an error in communicating with the host of the pod.
     *
     * More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-lifecycle#pod-phase
     */
    private string|null $phase = null;

    /**
     * podIP address allocated to the pod. Routable at least within the cluster. Empty
     * if not yet allocated.
     */
    private string|null $podIP = null;

    /**
     * podIPs holds the IP addresses allocated to the pod. If this field is specified,
     * the 0th entry must match the podIP field. Pods may be allocated at most 1 value
     * for each of IPv4 and IPv6. This list is empty if no IPs have been allocated yet.
     */
    private PodIPList $podIPs;

    /**
     * The Quality of Service (QOS) classification assigned to the pod based on
     * resource requirements See PodQOSClass type for available QOS classes More info:
     * https://kubernetes.io/docs/concepts/workloads/pods/pod-qos/#quality-of-service-classes
     */
    private string|null $qosClass = null;

    /**
     * A brief CamelCase message indicating details about why the pod is in this state.
     * e.g. 'Evicted'
     */
    private string|null $reason = null;

    /**
     * Status of resources resize desired for pod's containers. It is empty if no
     * resources resize is pending. Any changes to container resources will
     * automatically set this to "Proposed" Deprecated: Resize status is moved to two
     * pod conditions PodResizePending and PodResizeInProgress. PodResizePending will
     * track states where the spec has been resized, but the Kubelet has not yet
     * allocated the resources. PodResizeInProgress will track in-progress resizes, and
     * should be present whenever allocated resources != acknowledged resources.
     */
    private string|null $resize = null;

    /**
     * Status of resource claims.
     */
    private PodResourceClaimStatusList $resourceClaimStatuses;

    /**
     * RFC 3339 date and time at which the object was acknowledged by the Kubelet. This
     * is before the Kubelet pulled the container image(s) for the pod.
     */
    private DateTimeInterface|null $startTime = null;

    public function __construct()
    {
        $this->conditions = new PodConditionList();
        $this->containerStatuses = new ContainerStatusList();
        $this->ephemeralContainerStatuses = new ContainerStatusList();
        $this->hostIPs = new HostIPList();
        $this->initContainerStatuses = new ContainerStatusList();
        $this->podIPs = new PodIPList();
        $this->resourceClaimStatuses = new PodResourceClaimStatusList();
    }

    public function conditions(): PodConditionList
    {
        return $this->conditions;
    }

    public function containerStatuses(): ContainerStatusList
    {
        return $this->containerStatuses;
    }

    public function ephemeralContainerStatuses(): ContainerStatusList
    {
        return $this->ephemeralContainerStatuses;
    }

    public function getExtendedResourceClaimStatus(): PodExtendedResourceClaimStatus|null
    {
        return $this->extendedResourceClaimStatus;
    }

    public function getHostIP(): string|null
    {
        return $this->hostIP;
    }

    public function getMessage(): string|null
    {
        return $this->message;
    }

    public function getNominatedNodeName(): string|null
    {
        return $this->nominatedNodeName;
    }

    public function getObservedGeneration(): int|null
    {
        return $this->observedGeneration;
    }

    public function getPhase(): string|null
    {
        return $this->phase;
    }

    public function getPodIP(): string|null
    {
        return $this->podIP;
    }

    public function getQosClass(): string|null
    {
        return $this->qosClass;
    }

    public function getReason(): string|null
    {
        return $this->reason;
    }

    public function getResize(): string|null
    {
        return $this->resize;
    }

    public function getStartTime(): DateTimeInterface|null
    {
        return $this->startTime;
    }

    public function hostIPs(): HostIPList
    {
        return $this->hostIPs;
    }

    public function initContainerStatuses(): ContainerStatusList
    {
        return $this->initContainerStatuses;
    }

    public function podIPs(): PodIPList
    {
        return $this->podIPs;
    }

    public function resourceClaimStatuses(): PodResourceClaimStatusList
    {
        return $this->resourceClaimStatuses;
    }

    public function setConditions(PodConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setContainerStatuses(ContainerStatusList $containerStatuses): self
    {
        $this->containerStatuses = $containerStatuses;

        return $this;
    }

    public function setEphemeralContainerStatuses(ContainerStatusList $ephemeralContainerStatuses): self
    {
        $this->ephemeralContainerStatuses = $ephemeralContainerStatuses;

        return $this;
    }

    public function setExtendedResourceClaimStatus(PodExtendedResourceClaimStatus $extendedResourceClaimStatus): self
    {
        $this->extendedResourceClaimStatus = $extendedResourceClaimStatus;

        return $this;
    }

    public function setHostIP(string $hostIP): self
    {
        $this->hostIP = $hostIP;

        return $this;
    }

    public function setHostIPs(HostIPList $hostIPs): self
    {
        $this->hostIPs = $hostIPs;

        return $this;
    }

    public function setInitContainerStatuses(ContainerStatusList $initContainerStatuses): self
    {
        $this->initContainerStatuses = $initContainerStatuses;

        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setNominatedNodeName(string $nominatedNodeName): self
    {
        $this->nominatedNodeName = $nominatedNodeName;

        return $this;
    }

    public function setObservedGeneration(int $observedGeneration): self
    {
        $this->observedGeneration = $observedGeneration;

        return $this;
    }

    public function setPhase(string $phase): self
    {
        $this->phase = $phase;

        return $this;
    }

    public function setPodIP(string $podIP): self
    {
        $this->podIP = $podIP;

        return $this;
    }

    public function setPodIPs(PodIPList $podIPs): self
    {
        $this->podIPs = $podIPs;

        return $this;
    }

    public function setQosClass(string $qosClass): self
    {
        $this->qosClass = $qosClass;

        return $this;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function setResize(string $resize): self
    {
        $this->resize = $resize;

        return $this;
    }

    public function setResourceClaimStatuses(PodResourceClaimStatusList $resourceClaimStatuses): self
    {
        $this->resourceClaimStatuses = $resourceClaimStatuses;

        return $this;
    }

    public function setStartTime(DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'conditions' => $this->conditions,
            'containerStatuses' => $this->containerStatuses,
            'ephemeralContainerStatuses' => $this->ephemeralContainerStatuses,
            'extendedResourceClaimStatus' => $this->extendedResourceClaimStatus,
            'hostIP' => $this->hostIP,
            'hostIPs' => $this->hostIPs,
            'initContainerStatuses' => $this->initContainerStatuses,
            'message' => $this->message,
            'nominatedNodeName' => $this->nominatedNodeName,
            'observedGeneration' => $this->observedGeneration,
            'phase' => $this->phase,
            'podIP' => $this->podIP,
            'podIPs' => $this->podIPs,
            'qosClass' => $this->qosClass,
            'reason' => $this->reason,
            'resize' => $this->resize,
            'resourceClaimStatuses' => $this->resourceClaimStatuses,
            'startTime' => $this->startTime,
        ]);
    }
}
