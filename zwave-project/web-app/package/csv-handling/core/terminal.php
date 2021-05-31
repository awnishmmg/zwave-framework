<?php

echo "Terminal Executed";
$output=shell_exec("php test.php");
print_r($output);
