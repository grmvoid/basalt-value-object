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

use Basalt\ValueObject\Double;
use Basalt\ValueObject\Exception\ValueObjectException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Double::class)]
final class DoubleTest extends TestCase
{
    public function testFromFloatAndFromInt(): void
    {
        $d1 = Double::fromFloat(1.5);
        $d2 = Double::fromInt(2);

        self::assertSame(1.5, $d1->value());
        self::assertSame(2.0, $d2->value());
        self::assertSame('1.5', (string) $d1);
        self::assertSame('2', (string) $d2); // (string) 2.0 => '2'
    }

    public function testEqualsIsStrict(): void
    {
        $a = Double::fromFloat(0.3);
        $b = Double::fromFloat(0.1 + 0.2); // 0.30000000000000004
        $c = Double::fromFloat(0.3);

        self::assertFalse($a->equals($b)); // ścisłe ===
        self::assertTrue($a->equals($c));
    }

    public function testRejectsNaN(): void
    {
        $this->expectException(ValueObjectException::class);
        Double::fromFloat(NAN);
    }

    public function testRejectsInfinity(): void
    {
        self::expectException(ValueObjectException::class);
        Double::fromFloat(INF);
    }

    public function testRejectsNegativeInfinity(): void
    {
        self::expectException(ValueObjectException::class);
        Double::fromFloat(-INF);
    }
}
