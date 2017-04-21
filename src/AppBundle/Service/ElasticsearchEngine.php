<?php

namespace AppBundle\Service;

use Elasticsearch\ClientBuilder;

class ElasticsearchEngine
{

    public function search(string $query, Paginator $paginator)
    {

        $client = ClientBuilder::create()->build();

        $params = [
            'index' => 'products',
            'type' => 'product_name',
            'size' => $paginator::ITEM_PER_PAGE,
            'from' => $paginator->getStartIndex(),
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