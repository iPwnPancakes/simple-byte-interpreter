<?php

use Bytes\Endianness;
use Bytes\Interpreter;
use Bytes\WordOrder;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

class ByteInterpreterTest extends TestCase
{
    #[Test]

    #[TestWith([[0x00, 0xFF], 255, Endianness::BIG])]
    #[TestWith([[0xFF, 0x00], 255, Endianness::LITTLE])]

    #[TestWith([[0x12, 0x34], 4660, Endianness::BIG])]
    #[TestWith([[0x34, 0x12], 4660, Endianness::LITTLE])]
    public function should_interpret_16_bit_unsigned_integers_correctly(
        array $bytes,
        int $expected,
        Endianness $endianness
    ): void {
        $interpreter = Interpreter::create($endianness);

        $this->assertEquals($expected, $interpreter->bytes_to_16_unsigned_integer($bytes));
    }

    #[Test]

    #[TestWith([[0x00, 0x00, 0x00, 0xFF], 255, Endianness::BIG, WordOrder::NORMAL])]
    #[TestWith([[0x00, 0xFF, 0x00, 0x00], 255, Endianness::BIG, WordOrder::REVERSED])]

    #[TestWith([[0xFF, 0x00, 0x00, 0x00], 255, Endianness::LITTLE, WordOrder::NORMAL])]
    #[TestWith([[0x00, 0x00, 0xFF, 0x00], 255, Endianness::LITTLE, WordOrder::REVERSED])]
    public function should_interpret_32_bit_unsigned_integers_correctly(
        array $bytes,
        int $expected,
        Endianness $endianness,
        WordOrder $wordOrder
    ): void {
        $interpreter = Interpreter::create($endianness, $wordOrder);

        $this->assertEquals($expected, $interpreter->bytes_to_32_unsigned_integer($bytes));
    }
}
