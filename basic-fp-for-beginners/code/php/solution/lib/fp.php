<?php

function head($array) {
    return count($array) === 0 ? null : $array[0];
}

function tail($array) {
    return count($array) === 0 ? [] : array_slice($array, 1);
}

function bind($f, $args=[]) {
    return function () use ($f, $args) {
        return call_user_func_array(
            $f,
            array_merge($args, func_get_args())
        );
    };
}

function curryN($n, $f, $boundArgs=[]) {
    return function(/* ...$args */) use ($n, $f, $boundArgs) {
        $args = array_merge($boundArgs, func_get_args());
        return count($args) < $n
            ? bind(curryN($n, $f), $args)
            : call_user_func_array($f, $args);
    };
}

function prepend() {
    return curryN(2, function($x, $xs) {
        return array_merge([$x], $xs);
    }, func_get_args())();
}

function rang() {
    return curryN(2, $f = function($from, $to) use (&$f) {
        return $from >= $to
            ? []
            : prepend($from, $f($from + 1, $to));
    }, func_get_args())();
}

function map() {
    return curryN(2, $f = function($fn, $xs) use (&$f) {
        return count($xs) === 0
            ? []
            : prepend(call_user_func($fn, head($xs)), $f($fn, tail($xs)));
    }, func_get_args())();
}

function zip() {
    return curryN(2, $f = function($xs, $ys) use (&$f) {
        if (count($xs) !== count($ys)) {
            throw new Exception('Lists have different lengths');
        }

        return count($xs) === 0
            ? []
            : prepend([head($xs), head($ys)],
                      zip(tail($xs), tail($ys)));
    }, func_get_args())();
}

function foldr() {
    return curryN(3, $f = function($fn, $z, $xs) use (&$f) {
        return count($xs) === 0
            ? $z
            : call_user_func($fn, head($xs), $f($fn, $z, tail($xs)));
    }, func_get_args())();
}

function foldl() {
    return curryN(3, $f = function($fn, $z, $xs) use (&$f) {
        return count($xs) === 0
            ? $z
            : $f($fn, call_user_func($fn, $z, head($xs)), tail($xs));
    }, func_get_args())();
}

function pipe($fns) {
    return function($arg) use ($fns) {
        return foldl('T', head($fns)($arg), tail($fns));
    };
}

function add() {
    return curryN(2, function($a, $b) {
        return $a + $b;
    }, func_get_args())();
}

function sum($list) {
    return foldr('add', 0, $list);
}

function T() {
    return curryN(2, function($arg, $fn) {
        return call_user_func($fn, $arg);
    }, func_get_args())();
}

function A() {
    return curryN(2, function($fn, $arg) {
        return call_user_func($fn, $arg);
    }, func_get_args())();
}

function flip($fn) {
    return curryN(2, function($a, $b) use ($fn) {
        return call_user_func($fn, $b, $a);
    })();
}

function splitOn() {
    return curryN(2, function($expr, $str) {
        return preg_split("/{$expr}/", $str, -1, PREG_SPLIT_NO_EMPTY);
    }, func_get_args())();
}

function curry2($fn) {
    return curryN(2, $fn)();
}

function divMod() {
    return curryN(2, function($a, $b) {
        if ($b !== 0) {
            return [$a / $b, $a % $b];
        }
        throw new InvalidArgumentException('Cannot divide by zero');
    }, func_get_args())();
}

function apply() {
    return curryN(2, function($fn, $args) {
        return call_user_func_array($fn, $args);
    }, func_get_args())();
}
