<?php

namespace dao;

/**
 * Description of BaseDAO
 *
 * @author k-heiner@hotmail.com
 */
class Base {
    public static function checkHasError($connection, $statement) {

        $error = $statement->errorInfo();

        if ($error[0] != "0000" && $error[0] != "") {
            $connection->rollBack();
            self::createMessageError($statement);
        }
    }

    private static function createMessageError($statement) {
        $messageError = [
            "state"    => $statement->errorInfo()[0],
            "code"     => $statement->errorInfo()[1],
            "message"  => $statement->errorInfo()[2]
        ];

        $jsonMessage = json_encode($messageError);

        throw new \Exception($jsonMessage, 500);
    }
}
