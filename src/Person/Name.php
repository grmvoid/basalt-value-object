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

namespace Basalt\ValueObject\Person;

use Basalt\ValueObject\StringLiteral;

readonly class Name implements \Stringable
{
    public function __construct(
        private Firstname $firstname,
        private Lastname $lastname,
    ) {
    }

    public function firstname(): Firstname
    {
        return $this->firstname;
    }

    public function lastname(): Lastname
    {
        return $this->lastname;
    }

    public function fullname(): StringLiteral
    {
        return StringLiteral::fromString("$this->firstname $this->lastname");
    }

    public function equals(self $other): bool
    {
        return $this->fullname()->equals($other->fullname());
    }

    public function __toString(): string
    {
        return (string) $this->fullname();
    }
}
