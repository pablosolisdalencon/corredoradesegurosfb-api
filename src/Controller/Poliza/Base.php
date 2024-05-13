<?php

declare(strict_types=1);

namespace App\Controller\Poliza;

use App\Controller\BaseController;
use App\Service\Poliza\Create;
use App\Service\Poliza\Delete;
use App\Service\Poliza\Find;
use App\Service\Poliza\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindPoliza(): Find
    {
        return $this->container->get('find_poliza_service');
    }

    protected function getServiceCreatePoliza(): Create
    {
        return $this->container->get('create_poliza_service');
    }

    protected function getServiceUpdatePoliza(): Update
    {
        return $this->container->get('update_poliza_service');
    }

    protected function getServiceDeletePoliza(): Delete
    {
        return $this->container->get('delete_poliza_service');
    }
}
