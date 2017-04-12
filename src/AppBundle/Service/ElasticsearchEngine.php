<?php

namespace AppBundle\Service;

use Elasticsearch\ClientBuilder;

class ElasticsearchEngine
{

    public function search(string $query)
    {
        $client = ClientBuilder::create()->build();

        $params = [
            'index' => 'products',
            'type' => 'product_name',
            'size' => 20,
            'from' => 0,
            'body' => [
                'query' => [
                    'match' => [
                        'title' => $query
                    ]
                ]
            ]
        ];

        return $client->search($params);
    }

}