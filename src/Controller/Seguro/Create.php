<?php

declare(strict_types=1);

namespace App\Controller\Seguro;

use Slim\Http\Request;
use Slim\Http\Response;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $seguro = $this->getServiceCreateSeguro()->create($input);

        return $this->jsonResponse($response, 'success', $seguro, 201);
    }
}
