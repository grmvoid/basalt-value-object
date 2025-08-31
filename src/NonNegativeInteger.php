<?php

declare(strict_types=1);

/*
 * This file is part of the grmvoid/basalt-value-object.
 *
 * Copyright (C) Dominik Szamburski
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Basalt\ValueObject;

use Basalt\ValueObject\Exception\ValueObjectException;

readonly class NonNegativeInteger extends Integer
{
    #[\Override] protected function validate(): void
    {
        if ($this->value < 0) {
            throw new ValueObjectException("Provided number is not a non-negative integer. Given value: `{$this->value}`.");
        }
    }
}
