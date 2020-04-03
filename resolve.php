<?php

function display_reduced_form($arr)
{
    echo "Reduced form: ";
    foreach ($arr as $k => $v) {
        if ($v < 0) {
            echo "- " . -$v . " * X^" . $k . " ";
        } else if ($v > 0) {
            if ($k !== 0)
                echo "+ " . $v . " * X^" . $k . " ";
            else
                echo $v . " * X^" . $k . " ";
        }
    }
    echo "= 0\n";
}

function discriminant($arr)
{
    $dis = ($arr[1] * $arr[1]) - (4 * $arr[0] * $arr[2]);
    echo "The discriminant is : " . $dis . "\n";
    if ($dis > 0) {
        $x1 = (-$arr[1] + sqrt($dis)) / (2 * $arr[2]);
        $x2 = (-$arr[1] - sqrt($dis)) / (2 * $arr[2]);
        echo "Discriminant is strictly positive, the two solutions are:\n" . $x1 . "\n" . $x2 . "\n";

    } else if ($dis === 0) {
        $x = -$arr[1] / (2 * $arr[2]);
        echo "Discriminant equals zero, x1 = x2 = " . $x . "\n";
    } else {
        $sqrt = sqrt(-$dis);
        echo "Discriminant is strictly negative, there are no real solutions\nThe two complexes solutions are:\n";
        echo "(" . -$arr[1] . "+ i" .$sqrt .") / " . 2*$arr[2];
        echo "(" . -$arr[1] . "- i" .$sqrt .") / " . 2*$arr[2];
    }
}

function solve_type_one($arr)
{
    $res = -$arr[0] / $arr[1];
    echo "The solution is:\n" . $res . "\n";
}


function solve_zero($arr)
{
    if ($arr[0] != 0)
        echo "This is non-sense, " . $arr[0] . " isn't equal to zero !!!\n";
    else{
        echo "All numbers are solutions, well done you idiot\n";
    }
}

function resolve($arr)
{
    display_reduced_form($arr);
    echo "Polynomial degree: " . (sizeof($arr) - 1) . "\n";
    if ((sizeof($arr) - 1) >= 3) {
        echo "The polynomial degree is strictly greater than 2, I can't solve.\n";
        return;
    } else if ((sizeof($arr) - 1) === 1)
        solve_type_one($arr);
    else if ((sizeof($arr) - 1) === 2)
        discriminant($arr);
    else
        solve_zero($arr);
}

