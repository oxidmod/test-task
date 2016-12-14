<?php

namespace TestTask\Services\President\Factory;

/**
 * Class PresidentFactoryTest
 */
class PresidentFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PresidentFactory
     */
    private $factory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->factory = new PresidentFactory();
        parent::setUp();
    }

    public function testCreatePresident()
    {
        $name = 'Darth Vader';
        $birth = 3000;
        $death = 3100;

        $president = $this->factory->createPresident($name, $birth, $death);
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
        $birth = 3100;
        $death = 3000;
        $this->factory->createPresident($name, $birth, $death);
    }
}
