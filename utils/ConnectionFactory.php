<?php

namespace utils;

use config\Database as Database;

/**
 * Description of ConnectionFactory
 *
 * @author k-heiner@hotmail.com
 */
class ConnectionFactory {

    public $con = null;
    public $drive = Database::DRIVER;
    public $host = Database::HOST;
    public $user = Database::USER;
    public $password = Database::PASSWORD;
    public $name = Database::NAME;
    public $persistent = false;

    public function ConnectionFactory($persistent = false) {
        if ($persistent != false) {
            $this->persistent = true;
        }
    }

    public function getConnection() {

        try {
            $this->con = new \PDO(
                "{$this->drive}:host={$this->host};dbname={$this->name}",
                $this->user,
                $this->password,
                array(\PDO::ATTR_PERSISTENT => $this->persistent)
            );

            return $this->con;
        } catch (\PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function Close() {
        if ($this->con != null) {
            $this->con = null;
        }
    }

}
