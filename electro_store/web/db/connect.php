<?php
function connect_db()
{
    define("HOSTNAME", "electro.cgskcoeuw4rf.ap-southeast-1.rds.amazonaws.com"); // Endpoint of aws RDS
    define("DB", "electro");
    define("USERNAME", "postgresql");
    define("PASSWORD", "12345678");
    $connection_string = "host=" . HOSTNAME . " dbname=" . DB . " user=" . USERNAME . " password=" . PASSWORD . " ";
    $connection = pg_pconnect($connection_string);
    if (!$connection) {
        echo "<h3 style='color: red'>Connection failed!</h3>";
        return null;
    }
    return $connection;
}
