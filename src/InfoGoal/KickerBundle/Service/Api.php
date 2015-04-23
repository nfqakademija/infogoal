<?php
/**
 * Created by PhpStorm.
 * User: Ernestas
 * Date: 2015-04-14
 * Time: 09:47
 */

namespace InfoGoal\KickerBundle\Service;

use GuzzleHttp\Client;

class Api
{
    /**
     * @var string
     */
    private $baseUrl = "http://wonderwall.ox.nfq.lt/kickertable/api/v1/events";

    /**
     * @var string
     */
    private $loginName = "nfq";

    /**
     * @var string
     */
    private $loginPass = "labas";

    /**
     * @var DataAnalyzer
     */
    private $dataAnalyzer;

    public function __construct(DataAnalyzer $dataAnalyzer)
    {
        $this->dataAnalyzer = $dataAnalyzer;
    }

    /**
     * @return Response
     */
    public function readApi($options)
    {
        $fromID = 1;
        foreach ($options as $option) {
            if ($option->getOptionKey() == "last_event_id") {
                $fromID = $option->getOptionValue();
                break;
            }
        }

        $data = $this->getJsonData($fromID);

        return $this->dataAnalyzer->analyze($data, $options);
    }

    /**
     * @return array
     */
    public function getJsonData($fromID)
    {
        $client = new Client([
            'base_url' => $this->baseUrl
        ]);

        $query = array(
            'rows' => 100,
            'from-id' => $fromID
        );

        $response = $client->get('?' . http_build_query($query), ['auth' => [$this->loginName, $this->loginPass]]);

        $data = $response->json();

        if (!isset($data['records']))
            $data['records'] = [];

        return $data['records'];
    }
} 