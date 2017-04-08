<?php

namespace AppBundle\Service;

use Elasticsearch\ClientBuilder;

class ElasticsearchSynchronizer
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    public function sync(array $data): array
    {
        $params = ['body' => []];

        for ($i = 1, $num = count($data)-1; $i <= $num; $i++) {
            $params['body'][] = [
                'index' => [
                    '_index' => 'products',
                    '_type' => 'product_name'
                ]
            ];

            $params['body'][] = [
                'title' => $data[$i]
            ];
        }

        if (!empty($params['body'])) {
            return $this->client->bulk($params);
        }

        return [];
    }

}