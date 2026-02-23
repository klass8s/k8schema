<?php

declare(strict_types=1);

namespace K8Schema\Api\Storage\V1;

use ArrayObject;
use JsonSerializable;

/**
 * CSINodeSpec holds information about the specification of all CSI drivers
 * installed on a node
 */
class CSINodeSpec implements JsonSerializable
{
    /**
     * drivers is a list of information of all CSI Drivers existing on a node. If all
     * drivers in the list are uninstalled, this can become empty.
     */
    private CSINodeDriverList $drivers;

    public function __construct()
    {
        $this->drivers = new CSINodeDriverList();
    }

    public function drivers(): CSINodeDriverList
    {
        return $this->drivers;
    }

    public function setDrivers(CSINodeDriverList $drivers): self
    {
        $this->drivers = $drivers;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'drivers' => $this->drivers,
        ]);
    }
}
