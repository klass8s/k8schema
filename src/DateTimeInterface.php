<?php

declare(strict_types=1);

namespace K8Schema;

use JsonSerializable;

interface DateTimeInterface extends \DateTimeInterface, JsonSerializable
{
}
