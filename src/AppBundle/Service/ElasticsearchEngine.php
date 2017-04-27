<?php

namespace AppBundle\Service;

use Elasticsearch\ClientBuilder;

class ElasticsearchEngine
{
    protected $hosts;

    public function __construct(array $hosts)
    {
        $this->host = $hosts;
    }

    public function search(string $query, Paginator $paginator)
    {

        $client = ClientBuilder::create()->setHosts($this->hosts)->build();

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