<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;

/**
 * NodeSystemInfo is a set of ids/uuids to uniquely identify the node.
 */
class NodeSystemInfo implements JsonSerializable
{
    /**
     * The Architecture reported by the node
     */
    private string $architecture;

    /**
     * Boot ID reported by the node.
     */
    private string $bootID;

    /**
     * ContainerRuntime Version reported by the node through runtime remote API (e.g.
     * containerd://1.4.2).
     */
    private string $containerRuntimeVersion;

    /**
     * Kernel Version reported by the node from 'uname -r' (e.g. 3.16.0-0.bpo.4-amd64).
     */
    private string $kernelVersion;

    /**
     * Deprecated: KubeProxy Version reported by the node.
     */
    private string $kubeProxyVersion;

    /**
     * Kubelet Version reported by the node.
     */
    private string $kubeletVersion;

    /**
     * MachineID reported by the node. For unique machine identification in the cluster
     * this field is preferred. Learn more from man(5) machine-id:
     * http://man7.org/linux/man-pages/man5/machine-id.5.html
     */
    private string $machineID;

    /**
     * The Operating System reported by the node
     */
    private string $operatingSystem;

    /**
     * OS Image reported by the node from /etc/os-release (e.g. Debian GNU/Linux 7
     * (wheezy)).
     */
    private string $osImage;

    /**
     * SystemUUID reported by the node. For unique machine identification MachineID is
     * preferred. This field is specific to Red Hat hosts
     * https://access.redhat.com/documentation/en-us/red_hat_subscription_management/1/html/rhsm/uuid
     */
    private string $systemUUID;

    public function __construct(
        string $architecture,
        string $bootID,
        string $containerRuntimeVersion,
        string $kernelVersion,
        string $kubeProxyVersion,
        string $kubeletVersion,
        string $machineID,
        string $operatingSystem,
        string $osImage,
        string $systemUUID,
    ) {
        $this->architecture = $architecture;
        $this->bootID = $bootID;
        $this->containerRuntimeVersion = $containerRuntimeVersion;
        $this->kernelVersion = $kernelVersion;
        $this->kubeProxyVersion = $kubeProxyVersion;
        $this->kubeletVersion = $kubeletVersion;
        $this->machineID = $machineID;
        $this->operatingSystem = $operatingSystem;
        $this->osImage = $osImage;
        $this->systemUUID = $systemUUID;
    }

    public function getArchitecture(): string
    {
        return $this->architecture;
    }

    public function getBootID(): string
    {
        return $this->bootID;
    }

    public function getContainerRuntimeVersion(): string
    {
        return $this->containerRuntimeVersion;
    }

    public function getKernelVersion(): string
    {
        return $this->kernelVersion;
    }

    public function getKubeProxyVersion(): string
    {
        return $this->kubeProxyVersion;
    }

    public function getKubeletVersion(): string
    {
        return $this->kubeletVersion;
    }

    public function getMachineID(): string
    {
        return $this->machineID;
    }

    public function getOperatingSystem(): string
    {
        return $this->operatingSystem;
    }

    public function getOsImage(): string
    {
        return $this->osImage;
    }

    public function getSystemUUID(): string
    {
        return $this->systemUUID;
    }

    public function setArchitecture(string $architecture): self
    {
        $this->architecture = $architecture;

        return $this;
    }

    public function setBootID(string $bootID): self
    {
        $this->bootID = $bootID;

        return $this;
    }

    public function setContainerRuntimeVersion(string $containerRuntimeVersion): self
    {
        $this->containerRuntimeVersion = $containerRuntimeVersion;

        return $this;
    }

    public function setKernelVersion(string $kernelVersion): self
    {
        $this->kernelVersion = $kernelVersion;

        return $this;
    }

    public function setKubeProxyVersion(string $kubeProxyVersion): self
    {
        $this->kubeProxyVersion = $kubeProxyVersion;

        return $this;
    }

    public function setKubeletVersion(string $kubeletVersion): self
    {
        $this->kubeletVersion = $kubeletVersion;

        return $this;
    }

    public function setMachineID(string $machineID): self
    {
        $this->machineID = $machineID;

        return $this;
    }

    public function setOperatingSystem(string $operatingSystem): self
    {
        $this->operatingSystem = $operatingSystem;

        return $this;
    }

    public function setOsImage(string $osImage): self
    {
        $this->osImage = $osImage;

        return $this;
    }

    public function setSystemUUID(string $systemUUID): self
    {
        $this->systemUUID = $systemUUID;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'architecture' => $this->architecture,
            'bootID' => $this->bootID,
            'containerRuntimeVersion' => $this->containerRuntimeVersion,
            'kernelVersion' => $this->kernelVersion,
            'kubeProxyVersion' => $this->kubeProxyVersion,
            'kubeletVersion' => $this->kubeletVersion,
            'machineID' => $this->machineID,
            'operatingSystem' => $this->operatingSystem,
            'osImage' => $this->osImage,
            'systemUUID' => $this->systemUUID,
        ]);
    }
}
