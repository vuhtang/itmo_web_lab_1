<?php

class NumberValidator
{

    public function validateNumbers($x, $y, $r): bool
    {
        if (!(is_numeric($x) && is_numeric($y) && is_numeric($r))) return false;

        $possible_values_x = [-4, -3, -2, -1, 0, 1, 2, 3, 4];
        if (!in_array($x, $possible_values_x)) return false;

        if (!($y >= -3 && $y <= 5)) return false;

        $possible_values_r = [1, 1.5, 2, 2.5, 3];
        if (!in_array($r, $possible_values_r)) return false;

        return true;
    }

}
