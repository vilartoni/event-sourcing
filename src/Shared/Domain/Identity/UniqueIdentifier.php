<?php

namespace Vilartoni\Shared\Domain\Identity;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Vilartoni\Shared\Domain\ValueObject\StringValueObject;

class UniqueIdentifier extends StringValueObject
{
    private const IDENTIFIER_PATTERN = '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/';

    public function __construct(string $value = null)
    {
        if (is_null($value)) {
            $value = Uuid::uuid4()->toString();
        }

        $this->ensureValueIsValid($value);

        parent::__construct($value);
    }

    private function ensureValueIsValid(string $value): void
    {
        if (preg_match(self::IDENTIFIER_PATTERN, $value) !== 1) {
            throw new InvalidArgumentException(
                sprintf('Invalid value for UUID: \'%s\'', $value)
            );
        }
    }
}
