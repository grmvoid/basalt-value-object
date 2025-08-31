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

namespace BasaltTests\ValueObject\Unit\Identifier;

use Basalt\ValueObject\Exception\ValueObjectException;
use Basalt\ValueObject\Identifier\Uuid;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Uuid::class)]
final class UuidTest extends TestCase
{
    public function testFromStringAndAccessors(): void
    {
        $str = '42d1c66d-dbb3-44e1-a9b3-b4b6312cdd55';
        $vo = Uuid::fromString($str);

        self::assertSame($str, $vo->value());
        self::assertSame($str, (string)$vo);
    }

    public function testEquals(): void
    {
        $a = Uuid::fromString('42d1c66d-dbb3-44e1-a9b3-b4b6312cdd55');
        $b = Uuid::fromString('42d1c66d-dbb3-44e1-a9b3-b4b6312cdd55');
        $c = Uuid::fromString('aaaaaaaa-aaaa-4aaa-aaaa-aaaaaaaaaaaa');

        self::assertTrue($a->equals($b));
        self::assertFalse($a->equals($c));
    }

    public function testEqualsIsCaseSensitive(): void
    {
        $lower = Uuid::fromString('42d1c66d-dbb3-44e1-a9b3-b4b6312cdd55');
        $upper = Uuid::fromString('42D1C66D-DBB3-44E1-A9B3-B4B6312CDD55');

        self::assertTrue($lower->value() !== $upper->value());
        self::assertFalse($lower->equals($upper));
    }

    public function testToBytesAndFromBytesRoundTrip(): void
    {
        $original = '42d1c66d-dbb3-44e1-a9b3-b4b6312cdd55';
        $vo = Uuid::fromString($original);

        $bytes = $vo->toBytes();
        self::assertSame(16, strlen($bytes), 'UUID bytes should be 16 bytes long');

        $fromBytes = Uuid::fromBytes($bytes);
        self::assertSame($original, $fromBytes->value());
        self::assertTrue($vo->equals($fromBytes));
    }

    /**
     * @param non-empty-string $invalid
     */
    #[DataProvider('invalidUuidProvider')]
    public function testFromStringRejectsInvalid(string $invalid): void
    {
        $this->expectException(ValueObjectException::class);
        $this->expectExceptionMessage('not a valid UUID');
        Uuid::fromString($invalid);
    }

    /**
     * @return array<int, array{0: string}>
     */
    public static function invalidUuidProvider(): array
    {
        return [
            [''],
            ['not-a-uuid'],
            ['00000000-0000-0000-0000-00000000000Z'],
            ['42d1c66d-dbb3-44e1-a9b3-b4b6312cdd5'],
            ['42d1c66d-dbb3-44e1-a9b3-b4b6312cdd555'],
        ];
    }

    public function testFromBytesRejectsInvalidLength(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Uuid::fromBytes('short');
    }
}
