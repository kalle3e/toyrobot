<?php
include 'Includes/Libraries.php';

$fline = file('Files/instructionsData.txt');

$moveCount = 0;
$j = 0;
$store = new XyfStore();
$news = [NORTH, SOUTH, EAST, WEST];

for ($i=0; $i < count($fline); $i++)
{
    $line = explode(' ', $fline[$i]);
    if (1 < count($line) && PLACE !== $line[0])
    {
        errorDisplay();
    }
    if (1 < count($line))  // checking PLACE is good
    {
        $lineP2 = explode(',', $line[1]); //  for checking the 'PLACE' line
        if (is_numeric($lineP2[0]) && is_numeric($lineP2[1]) && in_array(rtrim($lineP2[2]),$news) )
        {
            if (PLACE == rtrim($line[0]) && 3 == count($lineP2))
            {
                $store = storeXyfPlace($line[1]);
                $storeXy = $store;
            }
            else
            {
                errorDisplay();
            }
        }
        else    // PLACE not in correct format
        {
            errorDisplay();
        }
    }
    else  // not 'PLACE' line
    {
        /**
         *  MOVE LEFT RIGHT REPORT
         */
        switch (rtrim($fline[$i])) {
            case PLACE:
                storeXyfPlace($fline[$i]);
                break;
            case MOVE:
                updateXy($storeXy);
                break;
            case LEFT:
                $storeXy->lStep = true;
                $storeFNew = getFacingDirectionNew($storeXy);
                $storeXy = $storeFNew;
                break;
            case RIGHT:
                $storeXy->rStep = true;
                $storeFNew = getFacingDirectionNew($storeXy);
                $storeXy = $storeFNew;
                break;
            case REPORT:
                reportNewCoords($storeXy);
                if ($i == count($fline))
                {exit;}
                else
                {break;}
            default:
                errorDisplay();
        }
    }
}
?>