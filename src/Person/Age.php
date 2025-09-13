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

namespace Basalt\ValueObject\Person;

use Basalt\ValueObject\Exception\ValueObjectException;
use Basalt\ValueObject\NonNegativeInteger;

final readonly class Age extends NonNegativeInteger
{
    private const int MAX_AGE = 150;

    #[\Override] protected function validate(): void
    {
        parent::validate();

        if ($this->value > static::MAX_AGE) {
            throw new ValueObjectException(
                sprintf('Age cannot be greater than %s.', static::MAX_AGE)
            );
        }
    }
}
