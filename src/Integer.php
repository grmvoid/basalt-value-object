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

readonly class Integer implements \Stringable
{
    final public function __construct(protected int $value)
    {
        $this->validate();
    }

    public static function fromInt(int $value): static
    {
        return new static($value);
    }

    protected function validate(): void
    {
    }

    final public function value(): int
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
