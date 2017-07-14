<?php

require_once __DIR__ . '/lib/fp.php';

$zipWithPows = curry2(function($p, $list) {
    return zip($list, rang($p, $p + count($list)));
});

$sumPows = function ($p) use ($zipWithPows) {
    return pipe([
        'toString',
        splitOn(''),
        map('toNumber'),
        $zipWithPows($p),
        map(apply('pow')),
        'sum'
    ]);
};

function findK1($n, $p) {
    global $sumPows;
    return pipe([
        $sumPows($p),
        flip('divMod')($n),
        function($divmod) {
            return $divmod[1] === 0 ? $divmod[0] : -1;
        }
    ])($n);
}

function toNumber($a) {
    return (int) $a;
}

function toString($a) {
    return (string) $a;
}
