<?php

namespace TestTask\Model\President;

/**
 * Class PresidentTest
 */
class PresidentTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $name = 'Darth Vader';
        $birth = 9999;
        $death = 11000;

        $president = new President($name, $birth, $death);
        self::assertEquals($name, $president->getName());
        self::assertEquals($birth, $president->getYearOfBirth());
        self::assertEquals($death, $president->getYearOfDeath());
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Year of death cannot be lower then year of birth
     */
    public function testFailIfDeathEarlierThenBirth()
    {
        $name = 'Darth Vader';
        $birth = 11000;
        $death = 9999;
        new President($name, $birth, $death);
    }
}
