<?php

declare(strict_types=1);

namespace K8Schema\Api\Apiserverinternal\V1alpha1;

use ArrayObject;
use JsonSerializable;

/**
 * StorageVersionSpec is an empty spec.
 */
class StorageVersionSpec implements JsonSerializable
{
    public function __construct()
    {
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
        ]);
    }
}
