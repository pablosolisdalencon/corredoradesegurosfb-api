<?php

declare(strict_types=1);

namespace App\Controller\Seguro;

use App\Controller\BaseController;
use App\Service\Seguro\Create;
use App\Service\Seguro\Delete;
use App\Service\Seguro\Find;
use App\Service\Seguro\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindSeguro(): Find
    {
        return $this->container->get('find_seguro_service');
    }

    protected function getServiceCreateSeguro(): Create
    {
        return $this->container->get('create_seguro_service');
    }

    protected function getServiceUpdateSeguro(): Update
    {
        return $this->container->get('update_seguro_service');
    }

    protected function getServiceDeleteSeguro(): Delete
    {
        return $this->container->get('delete_seguro_service');
    }
}
