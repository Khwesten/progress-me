<?php

namespace dao;

class QueryDao
{

    private $connection;

    public function __construct()
    {
        $connectionFactory = new \utils\ConnectionFactory();

        $this->connection = $connectionFactory->getConnection();

        $this->connection->beginTransaction();
    }

    public function select($sql)
    {

        $connection = $this->connection;

        $statement = $connection->prepare($sql);

        \dao\Base::checkHasError($connection, $statement);

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

        \dao\Base::checkHasError($connection, $statement);

        $connection->commit();

        $statement->closeCursor();

        return $statement->rowCount();
    }

}
