<?php

namespace controller;

use utils\Constants as Constants;

/**
 * Description of Query
 *
 * @author k-heiner@hotmail.com
 */
class Query {

    public static function select($query) {
        return self::templateQuery($query, Constants::SELECT);
    }

    public static function insert($query) {
        return self::templateQuery($query, Constants::INSERT);
    }

    public static function update($query) {
        return self::templateQuery($query, Constants::UPDATE);
    }

    public static function delete($query) {
        return self::templateQuery($query, Constants::DELETE);
    }

    private static function templateQuery($query, $method) {

        $query = str_replace('"', "'", $query);

        $queryDAO = new \dao\Query();

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

    private static function convertMessageInteract($hasAlterationInteger, $method) {
        $hasAlteration = filter_var($hasAlterationInteger, FILTER_VALIDATE_BOOLEAN);

        $arrayMessage = ["message" => ""];

        if ($hasAlteration) {
            $arrayMessage["message"] = Constants::$messageInteractSuccessful[$method];
        } else {
            $arrayMessage["message"] = Constants::$messageInteractFailure[$method];
        }

        return $arrayMessage;
    }

    private static function checkURLHasOnlyMethod($method, $query) {
        $hasOnlyTypeMethod = true;

        $query = strtolower($query);

        if (strstr($query, strtolower($method))) {
            $hasOnlyTypeMethod = !self::checkHasOthersMethods($method, $query);
        } else {
            $hasOnlyTypeMethod = false;
        }

        return $hasOnlyTypeMethod;
    }

    private function checkHasOthersMethods($typeMethod, $query) {
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
