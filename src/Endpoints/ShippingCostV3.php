<?php

declare(strict_types=1);

namespace FreteRapido\Endpoints;

use FreteRapido\Endpoints\Abstracts\Endpoint;

class ShippingCostV3 extends Endpoint
{

    public function calculate(array $args)
    {
        
        return $this->client->request($this->url(), 'POST', ['json' => $this->requestBody($args)]);
    }

    public function requestBody($args = [])
    {
        return [
            "shipper" => [
                "registered_number" => $this->client->auth['register_number'] ?? '' ,
                "token" => $this->client->auth['token'] ?? '',
                "platform_code" => $this->client->auth['platform_code'] ?? ''
            ],
            "recipient" => [
                "type" => $args['recipient']['type'] ?? '',
                "registered_number" => $args['recipient']['registered_number'] ?? '',
                "state_inscription" => "PR",
                "country" => "BRA",
                "zipcode" => $args['recipient']['zipcode']?? ''
            ],
            "dispatchers" => [
                [
                    "registered_number" => $args['dispatcher']['registered_number'] ?? '',
                    "zipcode" => $args['dispatcher']['zipcode'] ?? '',
                    "volumes" => $args['volumes'] ?? []
                ]
            ],
            "channel" => $args['channel'] ?? '',
            "filter" => $args['filter'] ?? 0,
            "limit" => $args['limit'] ?? 0,
            "identification" => $args['identification'] ?? '',
            "reverse" => $args['reverse'] ?? false,
            "simulation_type" => $args['simulation_type'] ?? [0],
        ];
    }

    public function url($args = [])
    {
        return self::BASE_URI_V3 .'/quote/simulate';
    }
}
