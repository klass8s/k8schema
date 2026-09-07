<?php

declare(strict_types=1);

namespace K8Schema\Api\Storage\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringMap;

/**
 * VolumeAttachmentStatus is the status of a VolumeAttachment request.
 */
class VolumeAttachmentStatus implements JsonSerializable
{
    /**
     * attachError represents the last error encountered during attach operation, if
     * any. This field must only be set by the entity completing the attach operation,
     * i.e. the external-attacher.
     */
    private VolumeError|null $attachError = null;

    /**
     * attached indicates the volume is successfully attached. This field must only be
     * set by the entity completing the attach operation, i.e. the external-attacher.
     */
    private bool $attached;

    /**
     * attachmentMetadata is populated with any information returned by the attach
     * operation, upon successful attach, that must be passed into subsequent
     * WaitForAttach or Mount calls. This field must only be set by the entity
     * completing the attach operation, i.e. the external-attacher.
     */
    private StringMap $attachmentMetadata;

    /**
     * detachError represents the last error encountered during detach operation, if
     * any. This field must only be set by the entity completing the detach operation,
     * i.e. the external-attacher.
     */
    private VolumeError|null $detachError = null;

    public function __construct(bool $attached)
    {
        $this->attached = $attached;
        $this->attachmentMetadata = new StringMap();
    }

    public function attachError(): VolumeError
    {
        return $this->attachError ??= new VolumeError();
    }

    public function attachmentMetadata(): StringMap
    {
        return $this->attachmentMetadata;
    }

    public function detachError(): VolumeError
    {
        return $this->detachError ??= new VolumeError();
    }

    public function getAttachError(): VolumeError|null
    {
        return $this->attachError;
    }

    public function getAttached(): bool
    {
        return $this->attached;
    }

    public function getDetachError(): VolumeError|null
    {
        return $this->detachError;
    }

    public function setAttachError(VolumeError $attachError): self
    {
        $this->attachError = $attachError;

        return $this;
    }

    public function setAttached(bool $attached): self
    {
        $this->attached = $attached;

        return $this;
    }

    public function setAttachmentMetadata(StringMap $attachmentMetadata): self
    {
        $this->attachmentMetadata = $attachmentMetadata;

        return $this;
    }

    public function setDetachError(VolumeError $detachError): self
    {
        $this->detachError = $detachError;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'attachError' => $this->attachError,
            'attached' => $this->attached,
            'attachmentMetadata' => $this->attachmentMetadata,
            'detachError' => $this->detachError,
        ]);
    }
}
