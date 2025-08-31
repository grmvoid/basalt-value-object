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

use Basalt\ValueObject\Boolean;
use Basalt\ValueObject\Exception\ValueObjectException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Boolean::class)]
class BooleanTest extends TestCase
{
    /**
     * @return array<int, list<bool|int|string>>
     */
    public static function trueProvider(): array
    {
        return [
            ['1'], ['true'], ['yes'], ['y'], ['on'],
            [1],
            ['TRUE'], ['Yes'], ['On']
        ];
    }

    /**
     * @return array<int, list<bool|int|string>>
     */
    public static function falseProvider(): array
    {
        return [
            ['0'], ['false'], ['no'], ['n'], ['off'],
            [0],
            ['FALSE'], ['No'], ['Off']
        ];
    }

    #[DataProvider('trueProvider')]
    public function testFromStringOrIntMapsToTrue(int|string $input): void
    {
        $vo = \is_int($input)
            ? Boolean::fromInt($input)
            : Boolean::fromString($input);

        self::assertTrue($vo->value());
        self::assertSame('true', (string) $vo);
    }

    #[DataProvider('falseProvider')]
    public function testFromStringOrIntMapsToFalse(int|string $input): void
    {
        $vo = \is_int($input)
            ? Boolean::fromInt($input)
            : Boolean::fromString($input);

        self::assertFalse($vo->value());
        self::assertSame('false', (string) $vo);
    }

    public function testFromBool(): void
    {
        $t = Boolean::fromBool(true);
        $f = Boolean::fromBool(false);

        self::assertTrue($t->value());
        self::assertFalse($f->value());
        self::assertTrue($t->equals(Boolean::fromString('true')));
        self::assertTrue($f->equals(Boolean::fromInt(0)));
    }

    public function testUnsupportedValueThrows(): void
    {
        $this->expectException(ValueObjectException::class);
        $this->expectExceptionMessage('Value could not be converted to boolean');
        Boolean::fromString('maybe');
    }
}
