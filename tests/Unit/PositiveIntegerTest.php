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
use Basalt\ValueObject\PositiveInteger;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PositiveInteger::class)]
final class PositiveIntegerTest extends TestCase
{
    public function testAcceptsPositive(): void
    {
        $p = new PositiveInteger(1);
        self::assertSame(1, $p->value());
        self::assertSame('1', (string) $p);
    }

    public function testZeroIsRejected(): void
    {
        $this->expectException(ValueObjectException::class);
        $this->expectExceptionMessage('not a positive integer');
        new PositiveInteger(0);
    }

    public function testNegativeIsRejected(): void
    {
        $this->expectException(ValueObjectException::class);
        new PositiveInteger(-5);
    }
}
