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

namespace BasaltTests\ValueObject\Unit;

use Basalt\ValueObject\Exception\ValueObjectException;
use Basalt\ValueObject\NonNegativeInteger;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(NonNegativeInteger::class)]
final class NonNegativeIntegerTest extends TestCase
{
    public function testAcceptsZero(): void
    {
        $n = new NonNegativeInteger(0);
        self::assertSame(0, $n->value());
        self::assertSame('0', (string) $n);
    }

    public function testAcceptsPositive(): void
    {
        $n = new NonNegativeInteger(42);
        self::assertSame(42, $n->value());
    }

    public function testNegativeIsRejected(): void
    {
        self::expectException(ValueObjectException::class);
        self::expectExceptionMessage('not a non-negative integer');
        new NonNegativeInteger(-1);
    }
}
