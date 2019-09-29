<?php
// Connecting, selecting database
$dbconn = pg_connect("host=db.ils.indiana.edu dbname=emarin port=5433 user=emarin password=zd97fCGq")
    or die('Could not connect: ' . pg_last_error());
?>
