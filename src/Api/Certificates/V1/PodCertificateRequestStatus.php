<?php

declare(strict_types=1);

namespace K8Schema\Api\Certificates\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ConditionList;
use K8Schema\DateTimeInterface;

/**
 * PodCertificateRequestStatus describes the status of the request, and holds the
 * certificate data if the request is issued.
 */
class PodCertificateRequestStatus implements JsonSerializable
{
    /**
     * beginRefreshAt is the time at which the kubelet should begin trying to refresh
     * the certificate.  This field is set via the /status subresource, and must be set
     * at the same time as certificateChain.  Once populated, this field is immutable.
     *
     * This field is only a hint.  Kubelet may start refreshing before or after this
     * time if necessary.
     */
    private DateTimeInterface|null $beginRefreshAt = null;

    /**
     * certificateChain is populated with an issued certificate by the signer. This
     * field is set via the /status subresource. Once populated, this field is
     * immutable.
     *
     * If the certificate signing request is denied, a condition of type "Denied" is
     * added and this field remains empty. If the signer cannot issue the certificate,
     * a condition of type "Failed" is added and this field remains empty.
     *
     * Validation requirements:
     *  1. certificateChain must consist of one or more PEM-formatted certificates.
     *  2. Each entry must be a valid PEM-wrapped, DER-encoded ASN.1 Certificate as
     *     described in section 4 of RFC5280.
     *
     * If more than one block is present, and the definition of the requested
     * spec.signerName does not indicate otherwise, the first block is the issued
     * certificate, and subsequent blocks should be treated as intermediate
     * certificates and presented in TLS handshakes.  When projecting the chain into a
     * pod volume, kubelet will drop any data in-between the PEM blocks, as well as any
     * PEM block headers.
     */
    private string|null $certificateChain = null;

    /**
     * conditions applied to the request.
     *
     * The types "Issued", "Denied", and "Failed" have special handling.  At most one
     * of these conditions may be present, and they must have status "True".
     *
     * If the request is denied with `Reason=UnsupportedKeyType`, the signer may
     * suggest a key type that will work in the message field.
     */
    private ConditionList $conditions;

    /**
     * notAfter is the time at which the certificate expires.  The value must be the
     * same as the notAfter value in the leaf certificate in certificateChain.  This
     * field is set via the /status subresource.  Once populated, it is immutable.  The
     * signer must set this field at the same time it sets certificateChain.
     */
    private DateTimeInterface|null $notAfter = null;

    /**
     * notBefore is the time at which the certificate becomes valid.  The value must be
     * the same as the notBefore value in the leaf certificate in certificateChain.
     * This field is set via the /status subresource.  Once populated, it is immutable.
     * The signer must set this field at the same time it sets certificateChain.
     */
    private DateTimeInterface|null $notBefore = null;

    public function __construct()
    {
        $this->conditions = new ConditionList();
    }

    public function conditions(): ConditionList
    {
        return $this->conditions;
    }

    public function getBeginRefreshAt(): DateTimeInterface|null
    {
        return $this->beginRefreshAt;
    }

    public function getCertificateChain(): string|null
    {
        return $this->certificateChain;
    }

    public function getNotAfter(): DateTimeInterface|null
    {
        return $this->notAfter;
    }

    public function getNotBefore(): DateTimeInterface|null
    {
        return $this->notBefore;
    }

    public function setBeginRefreshAt(DateTimeInterface $beginRefreshAt): self
    {
        $this->beginRefreshAt = $beginRefreshAt;

        return $this;
    }

    public function setCertificateChain(string $certificateChain): self
    {
        $this->certificateChain = $certificateChain;

        return $this;
    }

    public function setConditions(ConditionList $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function setNotAfter(DateTimeInterface $notAfter): self
    {
        $this->notAfter = $notAfter;

        return $this;
    }

    public function setNotBefore(DateTimeInterface $notBefore): self
    {
        $this->notBefore = $notBefore;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'beginRefreshAt' => $this->beginRefreshAt,
            'certificateChain' => $this->certificateChain,
            'conditions' => $this->conditions,
            'notAfter' => $this->notAfter,
            'notBefore' => $this->notBefore,
        ]);
    }
}
