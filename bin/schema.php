<?php
//binary; script CLI
declare(strict_types=1);

require_once dirname(__DIR__) . '/bootstrap.php';

loadSchema(
    connectDb(),
    DB_DIR . '/schema.sql'
);