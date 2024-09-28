<?php

declare(strict_types=1);

namespace FreteRapido\Endpoints;

use FreteRapido\Endpoints\Abstracts\Endpoint;

class ContractOffer extends Endpoint
{
    public function execute(array $args)
    {
        return $this->client->request($this->url($args), 'POST', ['json' => $this->requestBody($args)]);
    }

    public function requestBody($args = [])
    {
        $requestBody = [
            "remetente" => [
                "cnpj" => $args['remetente']['cnpj'],
            ],
            "expedidor" => [
                "cnpj" => "",
                "razao_social" => "",
                "inscricao_estadual" => "",
                "endereco" => [
                    "cep" => "",
                    "rua" => "",
                    "numero" => "",
                    "bairro" => "",
                    "complemento" => ""
                ]
            ],
            "destinatario" => [
                "cnpj_cpf" => "",
                "nome" => "",
                "email" => "",
                "telefone" => "",
                "endereco" => [
                    "cep" => "",
                    "rua" => "",
                    "numero" => "",
                    "bairro" => "",
                    "complemento" => "",
                    "cidade" => "",
                    "estado" => ""
                ]
            ],
            "metadados" => [
                [
                    "chave" => "",
                    "valor" => ""
                ]
            ],
            "numero_pedido" => "",
            "data_pedido" => "",
            "data_faturamento" => "",
            "forma_pagamento" => "",
            "obs_cliente" => "",
            "valor_frete_cobrado" => 0.00,
            "nota_fiscal" => [
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
            ],
            "data_coleta" => "",
            "canal" => "",
            "subcanal" => ""
        ];

        return $requestBody;
    }

    public function url($args = [])
    {
        return self::BASE_URI_V1 . '/quote/ecommerce/' . $args['oferta']['token'] .
            '/offer/' . $args['oferta']['id'] . '?token=' . $this->client->auth['token'];
    }
}
