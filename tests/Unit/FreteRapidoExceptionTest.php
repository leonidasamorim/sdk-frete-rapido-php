<?php

declare(strict_types=1);

namespace Unit;

use FreteRapido\Exceptions\FreteRapidoException;
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
        'height' => 0.250,
        'width' => 0.150,
        'length' => 0.080,
        'unitary_price' => 10,
        'unitary_weight' => 0.5
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

test("return error when shipper is incorrect", function () {

    $auth = [
        'register_number' => '1234567891523', /* invalid shipper */
        'token' => '123456',
        'platform_code' => 'ABC123'
    ];

    $this->freteRapido = new Client($auth);

    $result = $this->freteRapido->shippingCost()->calculate($this->args)->get();

    $shipping_cost = json_decode($result);

    expect(json_encode($shipping_cost))->toBeJson();

    expect($shipping_cost->status)->toEqual(400);
   
    expect($shipping_cost->error)->toEqual('Shipper not found');

});



test("return error when Freight not found", function () {

    $mock = new MockHandler([
        new Response(400, [], ""),
    ]);

    $this->freteRapido = new Client([], ['handler' => $mock]);

    $result = $this->freteRapido->shippingCost()->calculate($this->args)->get();

    $shipping_cost = json_decode($result);

    expect($result)->toBeJson();
    
    expect($shipping_cost->status)->toEqual(404);

    expect($shipping_cost->error)->toEqual('Freight not found');

});