<?php

namespace App\Util;

use Exception;
use App\Util\AppUtil;
use Illuminate\Http\Request;
use App\Enum\Ecommerce\ParameterRequestEnum;

class ManageUtil
{
    public static function getOderBy(Request $request, $defaultField = "id")
    {
        if(!AppUtil::isEmpty($request[ParameterRequestEnum::ORDER_BY])){
            $valueOrderBy = $request[ParameterRequestEnum::ORDER_BY];
            if(AppUtil::checkSpecialCharacterInString("-", $valueOrderBy)){
                $arrayOrderBy = explode("-", $valueOrderBy);
            }else{
                $arrayOrderBy = [$valueOrderBy, "asc"];
            }
        }else{
            $arrayOrderBy = [$defaultField, "asc"];
        }
        return $arrayOrderBy;
    }
}