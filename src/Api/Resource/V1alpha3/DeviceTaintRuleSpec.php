<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1alpha3;

use ArrayObject;
use JsonSerializable;

/**
 * DeviceTaintRuleSpec specifies the selector and one taint.
 */
class DeviceTaintRuleSpec implements JsonSerializable
{
    /**
     * DeviceSelector defines which device(s) the taint is applied to. All selector
     * criteria must be satisfied for a device to match. The empty selector matches all
     * devices. Without a selector, no devices are matches.
     */
    private DeviceTaintSelector|null $deviceSelector = null;

    /**
     * The taint that gets applied to matching devices.
     */
    private DeviceTaint $taint;

    public function __construct(DeviceTaint $taint)
    {
        $this->taint = $taint;
    }

    public function deviceSelector(): DeviceTaintSelector
    {
        return $this->deviceSelector ??= new DeviceTaintSelector();
    }

    public function getTaint(): DeviceTaint
    {
        return $this->taint;
    }

    public function setTaint(DeviceTaint $taint): self
    {
        $this->taint = $taint;

        return $this;
    }

    public function jsonSerialize(): ArrayObject
    {
        return new ArrayObject([
            'deviceSelector' => $this->deviceSelector,
            'taint' => $this->taint,
        ]);
    }
}
