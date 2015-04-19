<?php
/**
 * Created by PhpStorm.
 * User: Ernestas
 * Date: 2015-04-14
 * Time: 09:47
 */

namespace InfoGoal\KickerBundle\Model;

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
     * @return Response
     */
    public function readApi($options)
    {
        $data = $this->getJsonData();
        $analyzer = new DataAnalyzer($data);
        return $analyzer->analyze($options);
    }

    /**
     * @return array
     */
    public function getJsonData()
    {
        $config = array('base_url' => $this->baseUrl);
        $client = new Client($config);

        $query = array(
            'rows' => 100,
            'from-id' => 181601 // get this ID from database
        );

        $response = $client->get('?' . http_build_query($query), ['auth' => [$this->loginName, $this->loginPass]]);

        $data = $response->json();

        if(!isset($data['records']))
            $data['records'] = [];

        return $data['records'];
    }
} 