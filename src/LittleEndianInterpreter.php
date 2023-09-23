<?php

namespace Bytes;

class LittleEndianInterpreter extends Interpreter
{
    public function __construct(private readonly WordOrder $wordOrder) { }

    public function bytes_to_16_unsigned_integer(array $bytes): int
    {
        if (count($bytes) < 2) {
            // Add 0s to the end of the array until it has 2 elements
            $bytes = array_pad($bytes, 2, 0);
        } elseif (count($bytes) > 2) {
            $bytes = array_slice($bytes, 0, 2);
        }

        $bytes = $this->sanitizeBytes($bytes);

        return $bytes[1] << 8 | $bytes[0];
    }

    public function bytes_to_32_unsigned_integer(array $bytes): int
    {
        if (count($bytes) < 4) {
            $bytes = array_pad($bytes, 4, 0);
        } elseif (count($bytes) > 4) {
            $bytes = array_slice($bytes, 0, 4);
        }

        if ($this->wordOrder === WordOrder::REVERSED) {
            $bytes = $this->reverseWords($bytes);
        }

        $bytes = $this->sanitizeBytes($bytes);

        return $bytes[3] << 24 | $bytes[2] << 16 | $bytes[1] << 8 | $bytes[0];
    }
}
