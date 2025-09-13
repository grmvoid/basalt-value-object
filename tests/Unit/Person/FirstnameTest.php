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
use Basalt\ValueObject\Person\Firstname;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Firstname::class)]
class FirstnameTest extends TestCase
{
    public function testValidateWithValidFirstname(): void
    {
        $firstname = new Firstname(str_repeat('a', Firstname::MAX_LENGTH));
        self::assertSame(50, $firstname->length());
        self::assertSame(str_repeat('a', Firstname::MAX_LENGTH), $firstname->value());
    }

    public function testValidateWithExceedingLengthFirstname(): void
    {
        self::expectException(StringLengthExceededException::class);
        self::expectExceptionMessage('Firstname cannot be longer than "50" characters.');
        new Firstname(str_repeat('a', Firstname::MAX_LENGTH + 1));
    }
}
