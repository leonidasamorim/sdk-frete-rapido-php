<?php

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use FreteRapido\Client;


beforeEach(function () {

    $this->auth = ['token' => '123456'];

    $this->ContractOffer = new MockHandler([
        new Response(200, [], $this->jsonMock("ContractOffer")),
    ]);


    $this->args = [
        "oferta" => [
            "id" => 123456789,
            "token" => "FR2112026BGG1"
        ],
        "remetente" => [
            "cnpj" => "82193244000210"
        ],
        "expedidor" => [
            "cnpj" => "82193244000210",
            "razao_social" => "EXPEDITOR 01",
            "inscricao_estadual" => "123456",
            "endereco" => [
                "cep" => "",
                "rua" => "",
                "numero" => "",
                "bairro" => "",
                "complemento" => ""
            ]
        ],
        "destinatario" => [
            "cnpj_cpf" => "73489247272",
            "nome" => "LEONIDAS AMORIM",
            "email" => "leonidas.amorim@diprotec.com.br",
            "telefone" => "(41) 997182430",
            "endereco" => [
                "cep" => "81690410",
                "rua" => "Av Gov Jose Richa",
                "numero" => "17844",
                "bairro" => "Pinheirinho",
                "complemento" => "Bloco 03 - Apto 305",
                "cidade" => "Curitiba",
                "estado" => "PR"
            ]
        ],
        "metadados" => [
            [
                "chave" => "",
                "valor" => ""
            ]
        ],
        "nota_fiscal" => [
            [
                "numero" => "",
                "serie" => "",
                "quantidade_volumes" => "",
                "chave_acesso" => "",
                "valor" => 0.00,
                "valor_itens" => 0.00,
                "data_emissao" => "",
                "tipo_operacao" => 0,
                "tipo_emissao" => 0,
                "protocolo_autorizacao" => ""
            ]
        ],
        "numero_pedido" => "OFERTA-ABC-123",
        "data_pedido" => "2023-07-07 15:10:13",
        "data_faturamento" => "2023-07-10 15:10:13",
        "forma_pagamento" => "DINHEIRO",
        "obs_cliente" => "Ligar para cliente antes da entrega",
        "valor_frete_cobrado" => 14.40,
        "canal" => "",
        "subcanal" => "",
        "data_coleta" => ""
    ];
});

test("should return a contract of offer freight in json format", function () {

    $this->freteRapido = new Client($this->auth, ['handler' => $this->ContractOffer]);

    $result = $this->freteRapido->contractOffer()->execute($this->args)->get();

    $contract_offer = json_decode($result);

    expect($result)->toBeJson();

    expect($contract_offer->status)->toEqual(200);

    expect($contract_offer->id_frete)->not->toBeEmpty();

    expect($contract_offer->rastreio)->not->toBeEmpty();
});

test("should return a contract of offer freight in array format", function () {

    $this->freteRapido = new Client($this->auth, ['handler' => $this->ContractOffer]);

    $result = $this->freteRapido->contractOffer()->execute($this->args)->getArray();

    expect($result)->toBeArray();

    expect($result['status'])->toEqual(200);

    expect($result['id_frete'])->not->toBeEmpty();

    expect($result['rastreio'])->not->toBeEmpty();
});
