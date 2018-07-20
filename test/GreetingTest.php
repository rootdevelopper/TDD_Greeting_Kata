<?php

namespace tdd_tests\Tests;

use tdd_tests\Greeting;
use PHPUnit\Framework\TestCase;

class GreetingTest extends TestCase {

    public function testNullGreetName_returnsNullName()
    {
        $this->assertName(null, 'Hello, my friend');
    }

    public function testEmptyStringGreetName_returnsNullName()
    {
        $this->assertName('', 'Hello, my friend');
    }

    public function testGreetName_returnsGreetedName()
    {
        $this->assertName('Bob', 'Hello, Bob');
    }

    public function testGreetNameHsout_returnsGreetedNameShout()
    {
        $this->assertName('JERRY', 'HELLO JERRY!');
    }

    public function testGreetMultipleNames_returnsGreetedNames()
    {
        $this->assertName(['Jill','Jane'], 'Hello, Jill and Jane.');
    }

    public function testGreetMultipleNames_returnsGreetedNamesWithCommas()
    {
        $this->assertName(['Amy', 'Brian', 'Charlotte'], 'Hello, Amy, Brian, and Charlotte.');
    }

    public function testMixedGreetMultipleNames_returnsMixedGreetedNamesWithCommas()
    {
        $this->assertName(['Amy', 'BRIAN', 'Charlotte'], 'Hello, Amy and Charlotte. AND HELLO BRIAN!');
    }

    public function testMixedGreetMultipleNamesWithCommas_returnsMixedGreetedNamesWithCommas()
    {
        $this->assertName(["Bob", "Charlie, Dianne"],'Hello, Bob, Charlie, and Dianne.');
    }

    /**
     * @param $expected
     * @param $name
     */
    private function assertName($name, $expected): void
    {
        $test = new Greeting();
        $this->assertEquals($expected, $test->greet($name));
    }

}

