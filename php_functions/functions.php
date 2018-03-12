<?php


function winner($state)
{
    // ROW 0
    if($state[0] !== constant::EMPTY && ($state[0] == $state[1]) && ($state[1] == $state[2]) && ($state[0] == $state[2]))
    {
        return $state[0];
    }
    // ROW 1
    if($state[3] !== constant::EMPTY && ($state[3] == $state[4]) && ($state[4] == $state[5]) && ($state[5] == $state[3]))
    {
        return $state[3];
    }
    // ROW 2
    if($state[6] !== constant::EMPTY && ($state[6] == $state[7]) && ($state[7] == $state[8]) && ($state[8] == $state[6]))
    {
        return $state[6];
    }
    // COL 0
    if($state[0] !== constant::EMPTY && ($state[0] == $state[3]) && ($state[3] == $state[6]) && ($state[6] == $state[0]))
    {
        return $state[0];
    }
    // COL 1
    if($state[1] !== constant::EMPTY && ($state[1] == $state[4]) && ($state[4] == $state[7]) && ($state[7] == $state[1]))
    {
        return $state[1];
    }
    // COL 2
    if($state[2] !== constant::EMPTY && ($state[2] == $state[5]) && ($state[5] == $state[8]) && ($state[8] == $state[2]))
    {
        return $state[0];
    }
    // DIAGONAL 0 to 8
    if($state[0] !== constant::EMPTY && ($state[0] == $state[4]) && ($state[4] == $state[8]) && ($state[8] == $state[0]))
    {
        return $state[0];
    }
    // DIAGONAL 3 TO 6
    if($state[2] !== constant::EMPTY && ($state[2] == $state[4]) && ($state[4] == $state[6]) && ($state[6] == $state[2]))
    {
        return $state[2];
    }
    // NO WINNER
    else
    {
        return constant::NO_WINNER;
    }
}