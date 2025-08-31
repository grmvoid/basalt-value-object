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

namespace Basalt\ValueObject\Identifier;

use Basalt\ValueObject\Exception\ValueObjectException;

readonly class Uuid implements \Stringable
{
    /**
     * @param non-empty-string $value
     */
    final public function __construct(protected string $value)
    {
        $this->validate();
    }

    /**
     * @param non-empty-string $value
     */
    public static function fromString(string $value): static
    {
        return new static($value);
    }

    /**
     * @param non-empty-string $value
     */
    public static function fromBytes(string $value): static
    {
        return new static(\Ramsey\Uuid\Uuid::fromBytes($value)->toString());
    }

    protected function validate(): void
    {
        if (\Ramsey\Uuid\Uuid::isValid($this->value) === false) {
            throw new ValueObjectException("Provided string is not a valid UUID. Given value: `{$this->value}`.");
        }
    }

    final public function toBytes(): string
    {
        return \Ramsey\Uuid\Uuid::fromString($this->value)->getBytes();
    }

    final public function value(): string
    {
        return $this->value;
    }

    final public function equals(self $other): bool
    {
        return $this->value === $other->value();
    }

    final public function __toString(): string
    {
        return $this->value;
    }
}
