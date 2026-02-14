<?php

declare(strict_types=1);

namespace K8Schema\Api\Apps\V1;

use ArrayObject;
use K8Schema\APIResourceInterface;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ObjectMeta;
use K8Schema\Apimachinery\Pkg\Runtime\RawExtension;

/**
 * ControllerRevision implements an immutable snapshot of state data. Clients are
 * responsible for serializing and deserializing the objects that contain their
 * internal state. Once a ControllerRevision has been successfully created, it can
 * not be updated. The API Server will fail validation of all requests that attempt
 * to mutate the Data field. ControllerRevisions may, however, be deleted. Note
 * that, due to its use by both the DaemonSet and StatefulSet controllers for
 * update and rollback, this object is beta. However, it may be subject to name and
 * representation changes in future releases, and clients should not depend on its
 * stability. It is primarily for internal use by controllers.
 */
class ControllerRevision implements APIResourceInterface
{
    public const string API_VERSION = 'apps/v1';
    public const string KIND = 'ControllerRevision';

    /**
     * Data is the serialized representation of the state.
     */
    private RawExtension|null $data = null;

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta|null $metadata = null;

    /**
     * Revision indicates the revision of the state represented by Data.
     */
    private int $revision;

    public function __construct(int $revision)
    {
        $this->revision = $revision;
    }

    public function data(): RawExtension
    {
        return $this->data ??= new RawExtension();
    }

    public function getRevision(): int
    {
        return $this->revision;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata ??= new ObjectMeta();
    }

    public function setRevision(int $revision): self
    {
        $this->revision = $revision;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'data' => $this->data,
            'metadata' => $this->metadata,
            'revision' => $this->revision,
        ]);
    }
}
