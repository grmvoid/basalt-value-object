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

use Basalt\ValueObject\Integer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Integer::class)]
final class IntegerTest extends TestCase
{
    public function testFromIntAndValue(): void
    {
        $i = Integer::fromInt(123);
        self::assertSame(123, $i->value());
        self::assertSame('123', (string) $i);
    }

    public function testEquals(): void
    {
        $a = Integer::fromInt(10);
        $b = Integer::fromInt(10);
        $c = Integer::fromInt(11);

        self::assertTrue($a->equals($b));
        self::assertFalse($a->equals($c));
    }
}
