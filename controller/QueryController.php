<?php

namespace controller;

use service\QueryService;
use utils\Constants as Constants;

class QueryController
{

    public static function select($query)
    {
        return QueryService::templateQuery($query, Constants::SELECT);
    }

    public static function insert($query)
    {
        return QueryService::templateQuery($query, Constants::INSERT);
    }

    public static function update($query)
    {
        return QueryService::templateQuery($query, Constants::UPDATE);
    }

    public static function delete($query)
    {
        return QueryService::templateQuery($query, Constants::DELETE);
    }
}
