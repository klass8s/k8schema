<?php

declare(strict_types=1);

namespace K8Schema\Api\Coordination\V1alpha2;

use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * LeaseCandidateSpec is a specification of a Lease.
 */
class LeaseCandidateSpec implements JsonSerializable
{
    /**
     * BinaryVersion is the binary version. It must be in a semver format without
     * leading `v`. This field is required.
     */
    private string $binaryVersion;

    /**
     * EmulationVersion is the emulation version. It must be in a semver format without
     * leading `v`. EmulationVersion must be less than or equal to BinaryVersion. This
     * field is required when strategy is "OldestEmulationVersion"
     */
    private string|null $emulationVersion = null;

    /**
     * LeaseName is the name of the lease for which this candidate is contending. This
     * field is immutable.
     */
    private string $leaseName;

    /**
     * PingTime is the last time that the server has requested the LeaseCandidate to
     * renew. It is only done during leader election to check if any LeaseCandidates
     * have become ineligible. When PingTime is updated, the LeaseCandidate will
     * respond by updating RenewTime.
     */
    private DateTimeInterface|null $pingTime = null;

    /**
     * RenewTime is the time that the LeaseCandidate was last updated. Any time a Lease
     * needs to do leader election, the PingTime field is updated to signal to the
     * LeaseCandidate that they should update the RenewTime. Old LeaseCandidate objects
     * are also garbage collected if it has been hours since the last renew. The
     * PingTime field is updated regularly to prevent garbage collection for still
     * active LeaseCandidates.
     */
    private DateTimeInterface|null $renewTime = null;

    /**
     * Strategy is the strategy that coordinated leader election will use for picking
     * the leader. If multiple candidates for the same Lease return different
     * strategies, the strategy provided by the candidate with the latest BinaryVersion
     * will be used. If there is still conflict, this is a user error and coordinated
     * leader election will not operate the Lease until resolved. (Alpha) Using this
     * field requires the CoordinatedLeaderElection feature gate to be enabled.
     */
    private string $strategy;

    public function __construct(string $binaryVersion, string $leaseName, string $strategy)
    {
        $this->binaryVersion = $binaryVersion;
        $this->leaseName = $leaseName;
        $this->strategy = $strategy;
    }

    public function getBinaryVersion(): string
    {
        return $this->binaryVersion;
    }

    public function getEmulationVersion(): string|null
    {
        return $this->emulationVersion;
    }

    public function getLeaseName(): string
    {
        return $this->leaseName;
    }

    public function getPingTime(): DateTimeInterface|null
    {
        return $this->pingTime;
    }

    public function getRenewTime(): DateTimeInterface|null
    {
        return $this->renewTime;
    }

    public function getStrategy(): string
    {
        return $this->strategy;
    }

    public function setBinaryVersion(string $binaryVersion): self
    {
        $this->binaryVersion = $binaryVersion;

        return $this;
    }

    public function setEmulationVersion(string $emulationVersion): self
    {
        $this->emulationVersion = $emulationVersion;

        return $this;
    }

    public function setLeaseName(string $leaseName): self
    {
        $this->leaseName = $leaseName;

        return $this;
    }

    public function setPingTime(DateTimeInterface $pingTime): self
    {
        $this->pingTime = $pingTime;

        return $this;
    }

    public function setRenewTime(DateTimeInterface $renewTime): self
    {
        $this->renewTime = $renewTime;

        return $this;
    }

    public function setStrategy(string $strategy): self
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'binaryVersion' => $this->binaryVersion,
            'emulationVersion' => $this->emulationVersion,
            'leaseName' => $this->leaseName,
            'pingTime' => $this->pingTime,
            'renewTime' => $this->renewTime,
            'strategy' => $this->strategy,
        ];
    }
}
