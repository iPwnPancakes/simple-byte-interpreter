# Simple Byte Interpreter

This repository contains a simple byte to unsigned integer interpreter written in PHP. This has been tested on PHP 8.1.

It's main purpose is to demonstrate how endianness and word order affect the interpretation of bytes.

In this code, a "word" is made up of 2 bytes, which equals 16 bits. We chose 16 bits because a standard
called [IEC 61131-3 standard](https://en.wikipedia.org/wiki/IEC_61131-3#Data_types) says that's what a WORD should be.

# Installation

Make sure to run `composer install` before running the interpreter.

# Running the tests

Run `composer test` to run the tests.
