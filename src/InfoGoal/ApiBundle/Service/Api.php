<?php

namespace InfoGoal\ApiBundle\Service;

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

    /**
     * @param DataAnalyzer $dataAnalyzer
     */
    public function __construct(DataAnalyzer $dataAnalyzer)
    {
        $this->dataAnalyzer = $dataAnalyzer;
    }

    /**
     * @param array $options
     * @return Response
     */
    public function readApi($options)
    {
        $fromID = 0;
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
     * @param int $fromID
     * @param int $rows
     * @return array
     */
    public function getJsonData($fromID, $rows = 100)
    {
        $client = new Client([
            'base_url' => $this->baseUrl
        ]);

        if ($fromID !== 0) {
            $query = array(
                'rows' => $rows,
                'from-id' => $fromID
            );
        } else {
            $query = array(
                'rows' => 1
            );
        }

        $response = $client->get('?' . http_build_query($query), ['auth' => [$this->loginName, $this->loginPass]]);

        $data = $response->json();

        if (!isset($data['records']))
            $data['records'] = [];

        return $data['records'];
    }
} 