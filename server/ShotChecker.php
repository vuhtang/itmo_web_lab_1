<?php

class ShotChecker
{
    public function checkHit($x, $y, $r): bool
    {
        return $this->checkRectangle($x, $y, $r) || $this->checkTriangle($x, $y, $r) || $this->checkSector($x, $y, $r);
    }

    private function checkRectangle($x, $y, $r): bool
    {
        return $y >= -$r && $y <= 0 && $x >= 0 && $x <= $r / 2;
    }

    private function checkTriangle($x, $y, $r): bool
    {
        // y = -x + R
        return $y <= (-$x + $r) && $y >= 0 && $x >= 0;
    }

    private function checkSector($x, $y, $r): bool
    {
        // x^2 + y^2 = R^2/4
        return $x <= 0 && $y <= 0 && $x ** 2 + $y ** 2 <= $r ** 2 / 4;
    }
}