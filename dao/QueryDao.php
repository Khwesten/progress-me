<?php

namespace dao;

use \utils\ConnectionFactory;

class QueryDao
{

    private $connection;

    public function __construct()
    {
        $connectionFactory = new ConnectionFactory();

        $this->connection = $connectionFactory->getConnection();

        $this->connection->beginTransaction();
    }

    public function select($sql)
    {

        $connection = $this->connection;

        $statement = $connection->prepare($sql);

        BaseDao::checkHasError($connection, $statement);

        $statement->execute();

        $arrayResult = array();

        while ($row = $statement->fetch(\PDO::FETCH_OBJ)) {
            array_push($arrayResult, $row);
        }

        $statement->closeCursor();

        return $arrayResult;
    }

    public function interact($sql)
    {

        $connection = $this->connection;

        $statement = $connection->prepare($sql);

        $statement->execute();

        $statement->nextRowset();

        BaseDao::checkHasError($connection, $statement);

        $connection->commit();

        $statement->closeCursor();

        return $statement->rowCount();
    }

}
