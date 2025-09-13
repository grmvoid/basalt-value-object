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

use Basalt\ValueObject\Exception\StringLengthExceededException;
use Basalt\ValueObject\StringLiteral;

readonly class Firstname extends StringLiteral
{
    public const int MAX_LENGTH = 50;

    protected function validate(): void
    {
        parent::validate();

        if ($this->length() > static::MAX_LENGTH) {
            throw new StringLengthExceededException(
                sprintf('Firstname cannot be longer than "%s" characters.', static::MAX_LENGTH)
            );
        }
    }
}
