<?php

declare(strict_types=1);

namespace K8Schema;

use JsonSerializable;
use K8Schema\Apimachinery\Pkg\Apis\Meta\V1\ListMeta;

interface APIResourceListInterface extends JsonSerializable
{
    public function metadata(): ListMeta;
}
