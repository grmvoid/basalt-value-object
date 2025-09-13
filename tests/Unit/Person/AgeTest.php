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

use Basalt\ValueObject\Exception\ValueObjectException;
use Basalt\ValueObject\Person\Age;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Age::class)]
class AgeTest extends TestCase
{
    public function testValidateAcceptsValidAge(): void
    {
        $age = new Age(25);
        self::assertSame(25, $age->value());
    }

    public function testValidateAcceptsZeroAge(): void
    {
        $age = new Age(0);
        self::assertSame(0, $age->value());
    }

    public function testValidateThrowsExceptionForAgeExceedingMax(): void
    {
        self::expectException(ValueObjectException::class);
        self::expectExceptionMessage('Age cannot be greater than 150.');
        new Age(151);
    }

    public function testValidateThrowsExceptionForNegativeAge(): void
    {
        self::expectException(ValueObjectException::class);
        self::expectExceptionMessage('Provided number is not a non-negative integer. Given value: `-1`.');
        new Age(-1);
    }

    public function testValidateAcceptsMaxValidAge(): void
    {
        $age = new Age(150);
        self::assertSame(150, $age->value());
    }
}
