<?php

function autoloadApp($className) {
    $filename = __DIR__ . "/../" . $className . ".php";

    if (file_exists($filename)) {
        require $filename;
    }
}

spl_autoload_register("autoloadApp");
