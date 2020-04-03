<?php
include "resolve.php";

function find_degree($s)
{
    $deg = 0;
    for ($i = 0; $s[$i] != NULL; $i++) {
        if ($s[$i] === '^') {
            $deg = (intval($s[$i + 1]) > $deg) ? intval($s[$i + 1]) : $deg;
        }
    }
    return $deg;
}

function parsing($s, $deg)
{
    $arr = [];
    $i = 0;
    $n = 0;
    $x = 0;
    $val = '';
    $coef = 1;
    $decal = 0;
    while ($deg >= $n) {
        if ($s[$i] === '=')
            $coef = -1;
        if ($s[$i] === '^' && intval($s[$i + 1]) === $n) {
            while ($s[$i - $decal] !== '+' && $s[$i - $decal] !== '-' && $s[$i - $decal] !== '=' && $i != $decal) {
                $decal += 1;
            }
            if ($s[$i - $decal] === '-' || $s[$i - $decal] === '+' || $s[$i - $decal] === '=') {
                $coef = $s[$i - $decal] === '-' ? -$coef : $coef;
                $decal--;
            }
            while ($s[$i - $decal] != '*') {
                $val .= $s[$i - $decal];
                $decal--;
            }
            $x = $x + ($coef * floatval($val));
            $decal = 0;
            $val = '';
        }
        $i++;
        if ($s[$i] == NULL) {
            $i = 0;
            $n += 1;
            $coef = 1;
            $decal = 3;
            $arr[] .= $x;
            $x = 0;
        }
    }
    return $arr;
}

if ($argv[1]) {
    $s = str_replace(' ', '', $argv[1]);
    $deg = find_degree($s);
    $arr = parsing($s, $deg);
    resolve($arr);
}