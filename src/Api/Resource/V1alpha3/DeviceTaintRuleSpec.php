<?php

declare(strict_types=1);

namespace K8Schema\Api\Resource\V1alpha3;

use JsonSerializable;

/**
 * DeviceTaintRuleSpec specifies the selector and one taint.
 */
class DeviceTaintRuleSpec implements JsonSerializable
{
    /**
     * DeviceSelector defines which device(s) the taint is applied to. All selector
     * criteria must be satified for a device to match. The empty selector matches all
     * devices. Without a selector, no devices are matches.
     */
    private DeviceTaintSelector $deviceSelector;

    /**
     * The taint that gets applied to matching devices.
     */
    private DeviceTaint $taint;

    public function __construct(DeviceTaint $taint)
    {
        $this->deviceSelector = new DeviceTaintSelector();
        $this->taint = $taint;
    }

    public function deviceSelector(): DeviceTaintSelector
    {
        return $this->deviceSelector;
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

    public function jsonSerialize(): array
    {
        return [
            'deviceSelector' => $this->deviceSelector,
            'taint' => $this->taint,
        ];
    }
}
