<?php

namespace utils;

/**
 * Description of Constants
 *
 * @author k-heiner@hotmail.com
 */
class Constants {
    const SELECT = "SELECT";
    const INSERT = "INSERT";
    const DELETE = "DELETE";
    const UPDATE = "UPDATE";

    public static $methods = [
        "SELECT" => "SELECT",
        "INSERT" => "INSERT",
        "DELETE" => "DELETE",
        "UPDATE" => "UPDATE"
    ];

    public static $messageHasOtherMethod = [
        "SELECT" => "Nessa rota é permitido apenas queries de seleção.",
        "INSERT" => "Nessa rota é permitido apenas queries de inserçao.",
        "DELETE" => "Nessa rota é permitido apenas queries de remoção.",
        "UPDATE" => "Nessa rota é permitido apenas queries de atualização."
    ];

    public static $messageInteractSuccessful = [
        "INSERT" => "Inserção efetuada com sucesso.",
        "DELETE" => "Remoção efetuada com sucesso.",
        "UPDATE" => "Atualização efetuada com sucesso."
    ];

    public static $messageInteractFailure = [
        "INSERT" => "A inserção não afetou a base de dados.",
        "DELETE" => "A remoção não afetou a base de dados.",
        "UPDATE" => "A atualização não afetou a base de dados."
    ];
}
