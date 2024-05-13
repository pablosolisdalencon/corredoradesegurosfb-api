<?php

declare(strict_types=1);

namespace App\Controller\Cobertura;

use App\Controller\BaseController;
use App\Service\Cobertura\Create;
use App\Service\Cobertura\Delete;
use App\Service\Cobertura\Find;
use App\Service\Cobertura\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindCobertura(): Find
    {
        return $this->container->get('find_cobertura_service');
    }

    protected function getServiceCreateCobertura(): Create
    {
        return $this->container->get('create_cobertura_service');
    }

    protected function getServiceUpdateCobertura(): Update
    {
        return $this->container->get('update_cobertura_service');
    }

    protected function getServiceDeleteCobertura(): Delete
    {
        return $this->container->get('delete_cobertura_service');
    }
}
