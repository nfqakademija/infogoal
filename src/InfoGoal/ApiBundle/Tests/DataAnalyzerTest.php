<?php

use InfoGoal\ApiBundle\Service\DataAnalyzer;

class DataAnalyzerTest extends PHPUnit_Framework_TestCase {

    private $em;

    private $game;

    private $dataAnalyzer;

    public function setUp()
    {
        $this->em = $this
            ->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $this->game = $this
            ->getMockBuilder('InfoGoal\KickerBundle\Entity\Game')
            ->getMock();

        $this->calculator = $this
            ->getMockBuilder('InfoGoal\ApiBundle\Services\ExpCalculator')
            ->getMock();

        $this->achievements = $this
            ->getMockBuilder('InfoGoal\ApiBundle\Services\Achievements')
            ->getMock();

        $this->dataAnalyzer = new DataAnalyzer($this->em, $this->calculator, $this->achievements);
    }

    public function testGameIsStarted()
    {
        $this->dataAnalyzer->setActiveGame($this->game);
        $this->dataAnalyzer->markGameEnd(time());

        $this->assertEquals($this->dataAnalyzer->getGameIsStarted(), false);
    }

    public function testIfGameIsCreated()
    {
        $this->dataAnalyzer->markGameStart(time());
        $actual = $this->dataAnalyzer->getActiveGame();

        $this->assertInstanceOf('InfoGoal\KickerBundle\Entity\Game', $actual);
    }
}
 