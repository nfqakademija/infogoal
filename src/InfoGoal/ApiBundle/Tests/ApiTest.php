<?php

use InfoGoal\ApiBundle\Service\Api;

class ApiTest extends PHPUnit_Framework_TestCase
{

    public function testGetJsonData()
    {
        $dataAnalyzer = $this->getMockBuilder('InfoGoal\ApiBundle\Service\DataAnalyzer')
            ->disableOriginalConstructor()
            ->getMock();

        $api = new Api($dataAnalyzer);

        $actualData = $api->getJsonData(1, 3);
        $expectedData = [
            [
                'id' => 2,
                'timeSec' => 1412337046,
                'usec' => 310439,
                'type' => 'TableShake',
                'data' => '[]'
            ],
            [
                'id' => 3,
                'timeSec' => 1412337049,
                'usec' => 940268,
                'type' => 'TableShake',
                'data' => '[]'
            ],
            [
                'id' => 4,
                'timeSec' => 1412337049,
                'usec' => 940449,
                'type' => 'AutoGoal',
                'data' => '{"team":0}'
            ]
        ];

        $this->assertEquals($expectedData, $actualData);
    }
}
 