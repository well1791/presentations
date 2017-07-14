<?php

function curryN($n, $f) {
    return function() use ($n, $f) {
        $outterArgs = func_get_args();
        $curried = function() use($n, $f, $outterArgs) {
            return call_user_func_array(
                curryN($n, $f),
                array_merge($outterArgs, func_get_args())
            );
        };

        return count($outterArgs) >= $n
            ? call_user_func_array($f, $outterArgs)
            : $curried;
    };
}

function head($array) {
    return count($array) === 0 ? null : $array[0];
}

function tail($array) {
    return count($array) === 0 ? [] : array_slice($array, 1);
}

function prepend() {
    return call_user_func_array(curryN(2, function($x, $xs) {
        return array_merge([$x], $xs);
    }), func_get_args());
}

function rang() {
    return call_user_func_array(curryN(2, $f = function($from, $to) use (&$f) {
        return $from >= $to
            ? []
            : prepend($from, $f($from + 1, $to));
    }), func_get_args());
}

function map() {
    return call_user_func_array(curryN(2, $f = function($fn, $xs) use (&$f) {
        return count($xs) === 0
            ? []
            : prepend(call_user_func($fn, head($xs)), $f($fn, tail($xs)));
    }), func_get_args());
}

function zip() {
    return call_user_func_array(curryN(2, $f = function($xs, $ys) use (&$f) {
        if (count($xs) !== count($ys)) {
            throw new Exception('Lists have different lengths');
        }

        return count($xs) === 0
            ? []
            : prepend([head($xs), head($ys)],
                      zip(tail($xs), tail($ys)));
    }), func_get_args());
}

function foldr() {
    return call_user_func_array(curryN(3, $f = function($fn, $z, $xs) use (&$f) {
        return count($xs) === 0
            ? $z
            : call_user_func($fn, head($xs), $f($fn, $z, tail($xs)));
    }), func_get_args());
}

function foldl() {
    return call_user_func_array(curryN(3, $f = function($fn, $z, $xs) use (&$f) {
        return count($xs) === 0
            ? $z
            : $f($fn, call_user_func($fn, $z, head($xs)), tail($xs));
    }), func_get_args());
}

function pipe($fns) {
    return function($arg) use ($fns) {
        return foldl('T', head($fns)($arg), tail($fns));
    };
}

function add() {
    return call_user_func_array(curryN(2, function($a, $b) {
        return $a + $b;
    }), func_get_args());
}

function sum($list) {
    return foldr('add', 0, $list);
}

function T() {
    return call_user_func_array(curryN(2, function($arg, $fn) {
        return call_user_func($fn, $arg);
    }), func_get_args());
}

function A() {
    return call_user_func_array(curryN(2, function($fn, $arg) {
        return call_user_func($fn, $arg);
    }), func_get_args());
}

function flip($fn) {
    return curryN(2, function($a, $b) use ($fn) {
        return call_user_func($fn, $b, $a);
    });
}

function splitOn() {
    return call_user_func_array(curryN(2, function($expr, $str) {
        return preg_split("/{$expr}/", $str, -1, PREG_SPLIT_NO_EMPTY);
    }), func_get_args());
}

function curry2($fn) {
    return curryN(2, $fn);
}

function divMod() {
    return call_user_func_array(curryN(2, function($a, $b) {
        if ($b !== 0) {
            return [$a / $b, $a % $b];
        }
        throw new InvalidArgumentException('Cannot divide by zero');
    }), func_get_args());
}

function apply() {
    return call_user_func_array(curryN(2, function($fn, $args) {
        return call_user_func_array($fn, $args);
    }), func_get_args());
}
