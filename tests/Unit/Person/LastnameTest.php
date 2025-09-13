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

namespace BasaltTests\ValueObject\Unit\Unit\Person;

use Basalt\ValueObject\Exception\StringLengthExceededException;
use Basalt\ValueObject\Person\Lastname;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Lastname::class)]
class LastnameTest extends TestCase
{
    public function testValidLastname(): void
    {
        $lastname = new Lastname(str_repeat('a', Lastname::MAX_LENGTH));
        self::assertSame(str_repeat('a', Lastname::MAX_LENGTH), $lastname->value());
    }

    public function testLastnameExceedsMaxLength(): void
    {
        self::expectException(StringLengthExceededException::class);
        self::expectExceptionMessage('Lastname cannot be longer than "100" characters.');

        new Lastname(str_repeat('a', Lastname::MAX_LENGTH + 1));
    }
}
