<?php

declare(strict_types=1);

namespace K8Schema\Api\Core\V1;

use ArrayObject;
use JsonSerializable;
use K8Schema\Collection\StringList;

/**
 * NamespaceSpec describes the attributes on a Namespace.
 */
class NamespaceSpec implements JsonSerializable
{
    /**
     * Finalizers is an opaque list of values that must be empty to permanently remove
     * object from storage. More info:
     * https://kubernetes.io/docs/tasks/administer-cluster/namespaces/
     */
    private StringList $finalizers;

    public function __construct()
    {
        $this->finalizers = new StringList();
    }

    public function finalizers(): StringList
    {
        return $this->finalizers;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'finalizers' => $this->finalizers,
        ]);
    }
}
