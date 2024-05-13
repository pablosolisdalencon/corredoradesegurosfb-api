<?php

declare(strict_types=1);

namespace App\Controller\Cobertura;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetOne extends Base
{
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $cobertura = $this->getServiceFindCobertura()->getOne((int) $args['id']);

        return $this->jsonResponse($response, 'success', $cobertura, 200);
    }
}
