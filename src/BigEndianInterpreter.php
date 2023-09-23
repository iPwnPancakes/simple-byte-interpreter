<?php

namespace Bytes;

use function array_pad;

class BigEndianInterpreter extends Interpreter
{
    public function __construct(private readonly WordOrder $wordOrder) { }

    public function bytes_to_16_unsigned_integer(array $bytes): int
    {
        if (count($bytes) < 2) {
            // Pad the array with 0s until it has 2 elements
            $bytes = array_pad($bytes, -2, 0);
        } elseif (count($bytes) > 2) {
            $bytes = array_slice($bytes, count($bytes) - 2, 2);
        }

        $bytes = $this->sanitizeBytes($bytes);

        return $bytes[0] << 8 | $bytes[1];
    }

    public function bytes_to_32_unsigned_integer(array $bytes): int
    {
        if (count($bytes) < 4) {
            $bytes = array_pad($bytes, -4, 0);
        } elseif (count($bytes) > 4) {
            $bytes = array_slice($bytes, count($bytes) - 4, 4);
        }

        if ($this->wordOrder === WordOrder::REVERSED) {
            $bytes = $this->reverseWords($bytes);
        }

        $bytes = $this->sanitizeBytes($bytes);

        return $bytes[0] << 24 | $bytes[1] << 16 | $bytes[2] << 8 | $bytes[3];
    }
}
