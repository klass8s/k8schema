<?php

declare(strict_types=1);

namespace K8Schema\Api\Coordination\V1;

use JsonSerializable;
use K8Schema\DateTimeInterface;

/**
 * LeaseSpec is a specification of a Lease.
 */
class LeaseSpec implements JsonSerializable
{
    /**
     * acquireTime is a time when the current lease was acquired.
     */
    private DateTimeInterface|null $acquireTime = null;

    /**
     * holderIdentity contains the identity of the holder of a current lease. If
     * Coordinated Leader Election is used, the holder identity must be equal to the
     * elected LeaseCandidate.metadata.name field.
     */
    private string|null $holderIdentity = null;

    /**
     * leaseDurationSeconds is a duration that candidates for a lease need to wait to
     * force acquire it. This is measured against the time of last observed renewTime.
     */
    private int|null $leaseDurationSeconds = null;

    /**
     * leaseTransitions is the number of transitions of a lease between holders.
     */
    private int|null $leaseTransitions = null;

    /**
     * PreferredHolder signals to a lease holder that the lease has a more optimal
     * holder and should be given up. This field can only be set if Strategy is also
     * set.
     */
    private string|null $preferredHolder = null;

    /**
     * renewTime is a time when the current holder of a lease has last updated the
     * lease.
     */
    private DateTimeInterface|null $renewTime = null;

    /**
     * Strategy indicates the strategy for picking the leader for coordinated leader
     * election. If the field is not specified, there is no active coordination for
     * this lease. (Alpha) Using this field requires the CoordinatedLeaderElection
     * feature gate to be enabled.
     */
    private string|null $strategy = null;

    public function __construct()
    {
    }

    public function getAcquireTime(): DateTimeInterface|null
    {
        return $this->acquireTime;
    }

    public function getHolderIdentity(): string|null
    {
        return $this->holderIdentity;
    }

    public function getLeaseDurationSeconds(): int|null
    {
        return $this->leaseDurationSeconds;
    }

    public function getLeaseTransitions(): int|null
    {
        return $this->leaseTransitions;
    }

    public function getPreferredHolder(): string|null
    {
        return $this->preferredHolder;
    }

    public function getRenewTime(): DateTimeInterface|null
    {
        return $this->renewTime;
    }

    public function getStrategy(): string|null
    {
        return $this->strategy;
    }

    public function setAcquireTime(DateTimeInterface $acquireTime): self
    {
        $this->acquireTime = $acquireTime;

        return $this;
    }

    public function setHolderIdentity(string $holderIdentity): self
    {
        $this->holderIdentity = $holderIdentity;

        return $this;
    }

    public function setLeaseDurationSeconds(int $leaseDurationSeconds): self
    {
        $this->leaseDurationSeconds = $leaseDurationSeconds;

        return $this;
    }

    public function setLeaseTransitions(int $leaseTransitions): self
    {
        $this->leaseTransitions = $leaseTransitions;

        return $this;
    }

    public function setPreferredHolder(string $preferredHolder): self
    {
        $this->preferredHolder = $preferredHolder;

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
            'acquireTime' => $this->acquireTime,
            'holderIdentity' => $this->holderIdentity,
            'leaseDurationSeconds' => $this->leaseDurationSeconds,
            'leaseTransitions' => $this->leaseTransitions,
            'preferredHolder' => $this->preferredHolder,
            'renewTime' => $this->renewTime,
            'strategy' => $this->strategy,
        ];
    }
}
