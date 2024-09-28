<?php 


require __DIR__ . '/vendor/autoload.php';

use FreteRapido\Client;

$auth = [
    'register_number' => '82193244000210',
    'token' => '123',
    'platform_code' => 'ABC123'
];


$freteRapido = new Client($auth);

$item1 = [
    'amount' => 1,
    'amount_volumes' => 0,
    'category' => '999',
    'sku' => '21595',
    'tag' => '',
    'description' => 'Carregador de bateria Bosch GAL 12V-20 Bivolt BOSCH - teste',
    'height' => 0.260,
    'width' => 0.170,
    'length' => 0.060,
    'unitary_price' => 205.76,
    'unitary_weight' => 0.5,
    'consolidate' => false,
    'overlaid' => false,
    'rotate' => false
];


$args = [
    'dispatcher' => [
        'registered_number' => '82193244000210',
        'zipcode' => 80220030,
    ],
    'recipient' => [
        'type' => 0,
        'registered_number' => '73489247272', /* optional */
        'zipcode' => 81690410,
        'total_price' => 205.76
    ],
    'volumes' => [
        $item1 
    ]
];

$shipping_cost = $freteRapido->shippingCostV3()->calculate($args);

header('Content-Type: application/json');
echo $shipping_cost;