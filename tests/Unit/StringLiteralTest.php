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
use Basalt\ValueObject\StringLiteral;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RequiresPhpExtension;
use PHPUnit\Framework\TestCase;

#[CoversClass(StringLiteral::class)]
final class StringLiteralTest extends TestCase
{
    public function testFromStringValueAndToString(): void
    {
        $s = StringLiteral::fromString('Hello');
        self::assertSame('Hello', $s->value());
        self::assertSame('Hello', (string) $s);
        self::assertTrue($s->equals(StringLiteral::fromString('Hello')));
        self::assertFalse($s->equals(StringLiteral::fromString('World')));
    }

    public function testEmptyStringIsRejected(): void
    {
        self::expectException(ValueObjectException::class);
        self::expectExceptionMessage('String cannot be empty');
        StringLiteral::fromString('   ');
    }

    #[RequiresPhpExtension('mbstring')]
    public function testLengthWithUtf8(): void
    {
        $s = StringLiteral::fromString('żółw');
        self::assertSame(4, $s->length());
        self::assertSame(4, $s->length(StringLiteral::DEFAULT_ENCODING));
    }
}
