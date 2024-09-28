<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use FreteRapido\Client;


beforeEach(function () {

    $this->auth = [
        'register_number' => '82193244000210',
        'token' => '123456',
        'platform_code' => 'ABC123'
    ];

    $this->items = [[
        'amount' => 1,
        'category' => '999',
        'sku' => '123',
        'tag' => '',
        'description' => 'Produto descrição 01',
        'height' => 0.250,
        'width' => 0.150,
        'length' => 0.080,
        'unitary_price' => 10,
        'unitary_weight' => 0.5,
    ]];

    $this->args = [
        'dispatcher' => [
            'registered_number' => '82193244000210',
            'zipcode' => 80220030,
        ],
        'recipient' => [
            'type' => 0,
            'registered_number' => '12312312387',
            'zipcode' => 81690410,
        ],
        'volumes' => $this->items

    ];
});

test("should search for offers to shipping cost in json format", function () {

    $ShippingCost = new MockHandler([
        new Response(200, [], $this->jsonMock("ShippingCost")),
    ]);

    $this->freteRapido = new Client($this->auth, ['handler' => $ShippingCost]);

    $result = $this->freteRapido->shippingCost()->calculate($this->args)->get();

    $shipping_cost = json_decode($result);

    $dispatchers = $shipping_cost->dispatchers[0];

    expect(json_encode($shipping_cost))->toBeJson();

    expect($shipping_cost->status)->toEqual(200);

    expect($dispatchers->registered_number_shipper)->toEqual($this->auth['register_number']);

    expect($dispatchers->registered_number_dispatcher)->toEqual($this->args['dispatcher']['registered_number']);

    expect(count($dispatchers->offers))->toBeGreaterThanOrEqual(1);
});

test("should search for offers to shipping cost in array format", function () {

    $ShippingCost = new MockHandler([
        new Response(200, [], $this->jsonMock("ShippingCost")),
    ]);

    $this->freteRapido = new Client($this->auth, ['handler' => $ShippingCost]);

    $result = $this->freteRapido->shippingCost()->calculate($this->args)->getArray();

    expect($result)->toBeArray();

    expect($result['status'])->toEqual(200);
});
