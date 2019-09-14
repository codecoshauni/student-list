<?php

namespace Students;

trait Error404Output {
    function printError() {
        header("HTTP/1.0 404 Not Found");
        include_once('../templates/error.php');
        die();
    }
}