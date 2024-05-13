<?php

declare(strict_types=1);

namespace App\Controller\Aliado;

use App\Controller\BaseController;
use App\Service\Aliado\Create;
use App\Service\Aliado\Delete;
use App\Service\Aliado\Find;
use App\Service\Aliado\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindAliado(): Find
    {
        return $this->container->get('find_aliado_service');
    }

    protected function getServiceCreateAliado(): Create
    {
        return $this->container->get('create_aliado_service');
    }

    protected function getServiceUpdateAliado(): Update
    {
        return $this->container->get('update_aliado_service');
    }

    protected function getServiceDeleteAliado(): Delete
    {
        return $this->container->get('delete_aliado_service');
    }
}
