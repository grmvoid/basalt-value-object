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

readonly class Double implements \Stringable
{
    final public function __construct(protected float $value)
    {
        $this->validate();
    }

    public static function fromInt(int $value): static
    {
        return new static($value);
    }

    public static function fromFloat(float $value): static
    {
        return new static($value);
    }

    protected function validate(): void
    {
        if (\is_nan($this->value) || \is_infinite($this->value)) {
            throw new ValueObjectException("Double cannot be NaN or infinite. Given: `{$this->value}`.");
        }
    }

    final public function value(): float
    {
        return $this->value;
    }

    final public function equals(self $other): bool
    {
        return $this->value === $other->value();
    }

    final public function __toString(): string
    {
        return (string) $this->value;
    }
}
