<?php

namespace Bytes;

abstract class Interpreter
{
    public static function create(Endianness $endianness, WordOrder $wordOrder = WordOrder::NORMAL): Interpreter
    {
        return $endianness === Endianness::BIG
            ? new BigEndianInterpreter($wordOrder)
            : new LittleEndianInterpreter($wordOrder);
    }

    /**
     * @param  int[]  $bytes
     *
     * @return int
     */
    abstract public function bytes_to_16_unsigned_integer(array $bytes): int;

    abstract public function bytes_to_32_unsigned_integer(array $bytes): int;

    /**
     * This method ensures that each byte is only 8 bits long.
     *
     * @param  int[]  $bytes
     * @return int[]
     */
    protected function sanitizeBytes(array $bytes): array
    {
        for ($i = 0; $i < count($bytes); $i++) {
            $bytes[$i] = $bytes[$i] & 0xFF;
        }

        return $bytes;
    }

    /**
     * This method reverses the order of the words in the byte array. A word is 2 bytes (16 bits) long.
     *
     * @param  int[]  $bytes
     * @return int[]
     */
    protected function reverseWords(array $bytes): array
    {
        $words = array_chunk($bytes, 2);
        $reversedWords = array_reverse($words);

        return array_merge(...$reversedWords);
    }
}
