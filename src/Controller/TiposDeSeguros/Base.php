<?php

declare(strict_types=1);
namespace App\Controller\TiposDeSeguros;

use App\Controller\BaseController;
use App\Service\TiposDeSeguros\Create;
use App\Service\TiposDeSeguros\Delete;
use App\Service\TiposDeSeguros\Find;
use App\Service\TiposDeSeguros\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindTiposDeSeguros(): Find
    {
        return $this->container->get('find_tipos_de_seguros_service');
    }

    protected function getServiceCreateTiposDeSeguros(): Create
    {
        return $this->container->get('create_tipos_de_seguros_service');
    }

    protected function getServiceUpdateTiposDeSeguros(): Update
    {
        return $this->container->get('update_tipos_de_seguros_service');
    }

    protected function getServiceDeleteTiposDeSeguros(): Delete
    {
        return $this->container->get('delete_tipos_de_seguros_service');
    }
}
