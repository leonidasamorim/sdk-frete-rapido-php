<?php

declare(strict_types=1);

namespace FreteRapido\Exceptions;

class FreteRapidoException
{
    private $message;
    private $code;

    public function __construct(
        string $message = "",
        int $code = 0
    ) {
        $this->message = $message;
        $this->code = $code;
    }

    public function get(): string
    {
        header('Content-Type: application/json');

        return json_encode([
            'error' => $this->message,
            'status' => $this->code
        ]);
    }

    public function getArray(): array
    {
        return ([
            'error' => $this->message,
            'status' => $this->code
        ]);
    }
}
