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

readonly class StringLiteral implements \Stringable
{
    public const string DEFAULT_ENCODING = 'UTF-8';

    final public function __construct(protected string $value)
    {
        $this->validate();
    }

    public static function fromString(string $value): static
    {
        return new static($value);
    }

    protected function validate(): void
    {
        if (trim($this->value) === '') {
            throw new ValueObjectException('String cannot be empty.');
        }
    }

    public function length(?string $encoding = self::DEFAULT_ENCODING): int
    {
        return mb_strlen($this->value, $encoding);
    }

    final public function equals(self $other): bool
    {
        return $this->value === $other->value();
    }

    final public function value(): string
    {
        return $this->value;
    }

    final public function __toString(): string
    {
        return $this->value;
    }
}
