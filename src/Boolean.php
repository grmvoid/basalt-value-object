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

namespace Basalt\ValueObject;

use Basalt\ValueObject\Exception\ValueObjectException;

readonly class Boolean implements \Stringable
{
    protected const array FALSE_VALUES_MAP = [
        '0' => false,
        'false' => false,
        'no' => false,
        'n' => false,
        'off' => false
    ];

    protected const array TRUE_VALUES_MAP = [
        '1' => true,
        'true' => true,
        'yes' => true,
        'y' => true,
        'on' => true
    ];

    final public function __construct(protected bool $value)
    {
    }

    public static function fromBool(bool $value): static
    {
        return new static($value);
    }

    public static function fromString(string $value): static
    {
        return new static(self::convertToBoolean($value));
    }

    public static function fromInt(int $value): static
    {
        return new static(self::convertToBoolean($value));
    }

    final public function equals(self $other): bool
    {
        return $this->value === $other->value();
    }

    final public function value(): bool
    {
        return $this->value;
    }

    final public function __toString(): string
    {
        return $this->value ? 'true' : 'false';
    }

    private static function convertToBoolean(int|string $value): bool
    {
        $value = \strtolower((string) $value);

        if (isset(self::FALSE_VALUES_MAP[$value])) {
            return false;
        }

        if (isset(self::TRUE_VALUES_MAP[$value])) {
            return true;
        }

        throw new ValueObjectException("Value could not be converted to boolean, given value: `{$value}`.");
    }
}
