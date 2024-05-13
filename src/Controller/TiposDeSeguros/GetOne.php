<?php

declare(strict_types=1);

namespace App\Controller\TiposDeSeguros;

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
        $tipoDeSeguro = $this->getServiceFindTiposDeSeguros()->getOne((int) $args['id']);

        return $this->jsonResponse($response, 'success', $tipoDeSeguro, 200);
    }
}
