<?php

namespace AppBundle\Service;

use Elasticsearch\ClientBuilder;

class ElasticsearchSynchronizer
{
    protected $client;

    public function __construct(array $hosts)
    {
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
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
                'title' => $data[$i]['title'],
                'img' => $data[$i]['img'],
                'price' => $data[$i]['price']
            ];
        }

        if (!empty($params['body'])) {
            return $this->client->bulk($params);
        }

        return [];
    }

}