<?php

declare(strict_types=1);

namespace K8Schema\Api\Apiserverinternal\V1alpha1;

use JsonSerializable;

/**
 * StorageVersionSpec is an empty spec.
 */
class StorageVersionSpec implements JsonSerializable
{
    public function __construct()
    {
    }

    public function jsonSerialize(): array
    {
        return [
        ];
    }
}
