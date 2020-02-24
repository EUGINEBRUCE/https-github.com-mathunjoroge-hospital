<?php

$search = 'test test test test test';  
$search_q = implode(" & ", explode(" ", $search));

echo $search_q;