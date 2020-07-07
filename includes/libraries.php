<?php
include 'includes/constants.php';
class processXyf
{
    public $x = 0;
    public $y = 0;
    public $f;
    public $fNew;
    public $leftRight;

    public function storeXyfPlace($linePlace)
    {
        /**
         *  e.g PLACE 0,0,NORTH
         */
        $line = explode(',', $linePlace);

        if( !is_numeric( rtrim($line[0]) ) || !is_numeric( rtrim($line[1]) ) )
        {
            errorDisplay();
        }
        $this->x = intval($line[0]);
        $this->y = intval($line[1]);
        $this->f = rtrim($line[2]);
        $this->fNew = rtrim($line[2]);

        return $this;
    }
    public function updateXy()
    {
        /**
         *  Can't move further South from y=0
         *  Can't go beyond 0,0
         */

        if((SOUTH == $this->f) && (0 == $this->y))
        {
            echo 'Invalid. Enter again!';
            exit;
        }
        /**
         *   Can't move further West from x=0
         *   Can't go beyond 0,0
         */
        if((WEST == $this->f) && (0 == $this->x))
        {
            echo 'Invalid. Enter again!';
            exit;
        }
        /**
         *   Can't go beyond y = 5
         */
        if((NORTH == $this->f) && (5 == $this->y))
        {
            echo 'Invalid. Enter again!';
            exit;
        }
        /**
         *   Can't go beyond x = 5
         */
        if((EAST == $this->f) && (5 == $this->x))
        {
            echo 'Invalid. Enter again!';
            exit;
        }
        /**
         *   Update x or y
         */
        if (EAST == $this->f  || WEST == $this->f )
        {
            $this->x = $this->x + 1;
        }
        elseif (NORTH == $this->f  || SOUTH == $this->f)
        {
            $this->y = $this->y + 1;
        }
        return;
    }
    function getFacingDirectionNew()
    {

        $coordsMatrixes = array
        (
            "NORTH" => array
            (
                "LEFT" => "WEST",
                "RIGHT" => "EAST",
            ),
            "SOUTH" => array
            (
                "LEFT" => "EAST",
                "RIGHT" => "WEST",
            ),
            "EAST" => array
            (
                "LEFT" => "NORTH",
                "RIGHT" => "SOUTH",
            ),
            "WEST" => array
            (
                "LEFT" => "SOUTH",
                "RIGHT" => "NORTH",
            ),
        );
        foreach ($coordsMatrixes as $facingNEWSPlace => $leftrightC)
        {
            if ( $this->f == $facingNEWSPlace )
            {
                foreach ($leftrightC as $leftRightStepC => $newsNew)
                {
                    if ($this->leftRight == $leftRightStepC)
                    {
                        $this->fNew = $newsNew;
                        return;
                    }
                }
            }
        }
    }
    public function reportNewCoords()
    {
        echo PHP_EOL;
        echo '=========================================================';
        echo PHP_EOL;
        echo 'The new Coordinates: ' . $this->x .','. $this->y .',' . $this->fNew ;
        echo PHP_EOL;
        echo '=========================================================';
        echo PHP_EOL;
        return;
    }
}
function errorDisplay()
{
    echo PHP_EOL;
    echo '====================================================';
    echo PHP_EOL;
    echo 'Invalid. Enter again!';
    echo PHP_EOL;
    echo '====================================================';
    echo PHP_EOL;
    exit;
}
?>
