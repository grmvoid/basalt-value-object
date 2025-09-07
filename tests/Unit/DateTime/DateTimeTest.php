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

namespace BasaltTests\ValueObject\Unit\Unit\DateTime;

use Basalt\ValueObject\DateTime\DateTime;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(DateTime::class)]
class DateTimeTest extends TestCase
{
    public function testEqualsReturnsTrueForEqualDates(): void
    {
        $dateTime1 = DateTime::fromString('2025-01-02T00:00:00.000000+00:00');
        $dateTime2 = DateTime::fromString('2025-01-02T00:00:00.000000+00:00');

        self::assertTrue($dateTime1->equals($dateTime2));
    }

    public function testLessThanOrEqualReturnsTrueWhenDatesAreEqual(): void
    {
        $dateTime1 = DateTime::fromString('2025-01-02T00:00:00.000000+00:00');

        self::assertTrue(
            $dateTime1->lessThanOrEqual(DateTime::fromString('2025-01-02T00:00:00.000000+00:00'))
        );
    }

    public function testLessThanOrEqualReturnsTrueWhenFirstDateIsLess(): void
    {
        $dateTime1 = DateTime::fromString('2024-12-31T23:59:59+00:00');

        self::assertTrue(
            $dateTime1->lessThanOrEqual(DateTime::fromString('2025-01-02T00:00:00.000000+00:00'))
        );
    }

    public function testLessThanOrEqualReturnsFalseWhenFirstDateIsGreater(): void
    {
        $greaterDate = new DateTime(new \DateTimeImmutable('2025-01-03T00:00:00+00:00'));

        self::assertFalse(
            $greaterDate->lessThanOrEqual(DateTime::fromString('2025-01-02T00:00:00.000000+00:00'))
        );
    }

    public function testEqualsReturnsFalseForDifferentDates(): void
    {
        $dateTime = DateTime::fromString('2025-01-03T00:00:00.000000+00:00');

        self::assertFalse(
            $dateTime->equals(DateTime::fromString('2025-01-02T00:00:00+00:00'))
        );
    }

    public function testGreaterThanOrEqualReturnsTrueWhenFirstDateIsGreater(): void
    {
        $greaterDate = DateTime::fromString('2025-01-02T00:00:00+00:00');

        self::assertTrue(
            $greaterDate->greaterThanOrEqual(DateTime::fromString('2025-01-02T00:00:00.000000+00:00'))
        );
    }

    public function testGreaterThanOrEqualReturnsTrueWhenDatesAreEqual(): void
    {
        $dateTime = DateTime::fromString('2025-01-02T00:00:00.000000+00:00');

        self::assertTrue(
            $dateTime->greaterThanOrEqual(DateTime::fromString('2025-01-02T00:00:00.000000+00:00'))
        );
    }

    public function testGreaterThanOrEqualReturnsFalseWhenFirstDateIsLess(): void
    {
        $lesserDate = DateTime::fromString('2024-12-31T23:59:59+00:00');

        self::assertFalse(
            $lesserDate->greaterThanOrEqual(DateTime::fromString('2025-01-02T00:00:00.000000+00:00'))
        );
    }
}
