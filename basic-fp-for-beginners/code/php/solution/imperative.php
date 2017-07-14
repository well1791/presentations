<?php

function findK($n, $p) {
    $ns = preg_split("//", $n, -1, PREG_SPLIT_NO_EMPTY);
    $sum = 0;

    foreach ($ns as $k => $v) {
        $sum += pow($v, $p + $k);
    }

    $div = $sum / $n;
    $mod = $sum % $n;

    return $mod === 0 ? $div : -1;
}
