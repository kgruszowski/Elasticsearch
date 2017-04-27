<?php

namespace AppBundle\Service;

use Elasticsearch\ClientBuilder;

class ElasticsearchEngine
{
    protected $client;

    public function __construct(array $hosts)
    {
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }

    public function search(string $query, Paginator $paginator)
    {
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

        return $this->client->search($params);
    }

}