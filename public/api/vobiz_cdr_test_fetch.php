<?php
require './vobiz_cdr_fetch.php';

$res = fetchVobizCDR(1, 5);

// dump everything
echo "<pre>";
print_r($res);
echo "</pre>";
