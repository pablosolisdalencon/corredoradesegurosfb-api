<?php

declare(strict_types=1);

namespace App\Controller\Aliado;

use Slim\Http\Request;
use Slim\Http\Response;

final class Update extends Base
{
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $input = (array) $request->getParsedBody();
        $id = (int) $args['id'];
        $aliado = $this->getServiceUpdateAliado()->update($input, $id);

        return $this->jsonResponse($response, 'success', $aliado, 200);
    }
}

