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

namespace Basalt\ValueObject\DateTime;

use Basalt\ValueObject\Exception\ValueObjectException;

readonly class DateTime implements \Stringable
{
    final public function __construct(protected \DateTimeImmutable $value)
    {
        $this->validate();
    }

    public static function fromString(string $value): static
    {
        try {
            return new static(new \DateTimeImmutable($value));
        } catch (\DateMalformedStringException) {
            throw new ValueObjectException(
                sprintf(
                    'The string <"%s"> is not a valid date time.',
                    $value
                ),
            );
        }
    }

    protected function validate(): void
    {
    }
    final public function equals(self $other): bool
    {
        return $this->format() === $other->format();
    }

    public function greaterThan(self $other): bool
    {
        return $this->value > $other->value();
    }

    public function greaterThanOrEqual(self $other): bool
    {
        return $this->value >= $other->value();
    }

    public function lessThan(self $other): bool
    {
        return $this->value < $other->value();
    }

    public function lessThanOrEqual(self $other): bool
    {
        return $this->value <= $other->value();
    }

    public function modify(string $modify): static
    {
        return new static(
            $this->value->modify($modify)
        );
    }

    final public function value(): \DateTimeImmutable
    {
        return $this->value;
    }

    final public function __toString(): string
    {
        return $this->format();
    }

    final public function format(string $format = \DateTimeInterface::ATOM): string
    {
        return $this->value->format($format);
    }
}
