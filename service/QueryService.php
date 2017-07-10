<?php

namespace service;

class QueryService
{
    public static function templateQuery($query, $method)
    {

        $query = str_replace('"', "'", $query);

        $queryDAO = new \dao\QueryDao();

        $hasOnlyMethod = self::checkURLHasOnlyMethod($method, $query);

        if (!$hasOnlyMethod) {
            return json_encode(["message" => Constants::$messageHasOtherMethod[$method]]);
        }

        try {
            if ($method == Constants::SELECT) {
                $result = $queryDAO->select($query);
            } else {
                $result = self::convertMessageInteract($queryDAO->interact($query), $method);
            }
        } catch (Exception $exc) {
            return $exc;
        }

        $jsonResult = json_encode($result);

        return $jsonResult;
    }

    private static function convertMessageInteract($hasAlterationInteger, $method)
    {
        $hasAlteration = filter_var($hasAlterationInteger, FILTER_VALIDATE_BOOLEAN);

        $arrayMessage = ["message" => ""];

        if ($hasAlteration) {
            $arrayMessage["message"] = Constants::$messageInteractSuccessful[$method];
        } else {
            $arrayMessage["message"] = Constants::$messageInteractFailure[$method];
        }

        return $arrayMessage;
    }

    private static function checkURLHasOnlyMethod($method, $query)
    {
        $query = strtolower($query);

        if (strstr($query, strtolower($method))) {
            $hasOnlyTypeMethod = !self::checkHasOthersMethods($method, $query);
        } else {
            $hasOnlyTypeMethod = false;
        }

        return $hasOnlyTypeMethod;
    }

    private function checkHasOthersMethods($typeMethod, $query)
    {
        $methods = Constants::$methods;
        unset($methods[$typeMethod]);
        $othersMethod = $methods;

        $hasOtherMethod = false;

        foreach ($othersMethod as $method) {
            $stringLowerMethod = strtolower($method);

            if (strstr($query, $stringLowerMethod)) {
                $hasOtherMethod = true;
            }
        }

        return $hasOtherMethod;
    }
}