# FreteRapido PHP SDK


Abaixo o SDK possui exemplos de como consultar as cotações para frete além de realizar contratações.

## Instalação

Via Composer

``` bash
$ composer require diprotec-dev/sdk-frete-rapido-php
```

## Como usar

### shippingCost

Recuperar lista de ofertas de frete.

```php

use FreteRapido\Client;

$auth = [
    'register_number' => '82193244000210',
    'token' => '1234567891012131415',
    'platform_code' => 'ABC123456'
];


$freteRapido = new Client($auth);

$args = [
    'dispatcher' => [
        'registered_number' => '82193244000210',
        'zipcode' => 80220030,
    ],
    'recipient' => [
        'type' => 0,
        'registered_number' => '12312312387',
        'zipcode' => 81690410,
    ],
];

$shipping_cost = $freteRapido->shippingCost()->calculate($args)->get();

echo $shipping_cost;

```

Você deve receber um retorno semelhante ao array abaixo:

```json
{
    "dispatchers": [
        {
            "id": "64a2d37961dc798a7763f9ec",
            "request_id": "64a2d37961dc798a7763f9eb",
            "registered_number_shipper": "82193244000210",
            "registered_number_dispatcher": "82193244000210",
            "zipcode_origin": 80220030,
            "offers": [
                {
                    "offer": 1,
                    "table_reference": "6479e0cec786333ffdf53747",
                    "simulation_type": 0,
                    "carrier": {
                        "name": "LOGGI",
                        "registered_number": "18277493000177",
                        "state_inscription": "ISENTO",
                        "logo": "https://s3.amazonaws.com/public.prod.freterapido.uploads/transportadora/foto-perfil/18277493000177.PNG",
                        "reference": 743,
                        "company_name": "LOGGI TECNOLOGIA LTDA"
                    },
                    "service": "Loggi Express",
                    "delivery_time": {
                        "days": 1,
                        "estimated_date": "2023-07-04"
                    },
                    "expiration": "2023-08-02T13:56:09.615666342Z",
                    "cost_price": 12.1,
                    "final_price": 12.1,
                    "weights": {
                        "real": 0.5,
                        "cubed": 0.442,
                        "used": 0.5
                    },
                    "original_delivery_time": {
                        "days": 1,
                        "estimated_date": "2023-07-04"
                    }
                },
                {
                    "offer": 2,
                    "table_reference": "6491b2603096e09a8a99e372",
                    "simulation_type": 0,
                    "carrier": {
                        "name": "TOTAL EXPRESS",
                        "registered_number": "73939449000193",
                        "state_inscription": "206.214.714.111",
                        "logo": "https://s3.amazonaws.com/public.prod.freterapido.uploads/transportadora/foto-perfil/73939449000193.png",
                        "reference": 693,
                        "company_name": "TEX COURIER LTDA."
                    },
                    "service": "Expresso",
                    "delivery_time": {
                        "days": 3,
                        "estimated_date": "2023-07-06"
                    },
                    "expiration": "2023-08-02T13:56:09.615672828Z",
                    "cost_price": 14.19,
                    "final_price": 14.19,
                    "weights": {
                        "real": 0.5,
                        "cubed": 0.442,
                        "used": 0.5
                    },
                    "original_delivery_time": {
                        "days": 3,
                        "estimated_date": "2023-07-06"
                    }
                }
            ],
            "total_price": 205.76
        }
    ]
}


```

## Teste

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email ti@diprotec.com.br instead of using the issue tracker.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
