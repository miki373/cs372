<?php
/**
 * Created by PhpStorm.
 * User: miki__000
 * Date: 2018-02-12
 * Time: 9:50 PM
 */
// Constants that are used by AI agent
ini_set('error_reporting', E_STRICT);
class constant
{
    const WIDTH = 3;
    const SIZE = 9;
    const EMPTY = -1;
    const NO_MOVES = "no_moves";
    const NO_WINNER = "no_winner";
    const X = 'x';
    const O = 'o';
    const NO_MOVE = 'null';
}

// Data storage
class moves
{
    public $score;
    public $position;
}



class AI
{
    private $game_state = array();
    private $ai_move;

    public function set_game_state($current_game_state)
    {
        $this->game_state = $current_game_state;
    }

    public function make_move($state, $position, $player)
    {
        $state[$position] = $player;
    }

    /*Check if there are moves left to be made.
    If there are no more moves left, then return
    false, game has ended, it there are return true*/
    public function has_moves($state)
    {
        foreach ($state as $tile) {

            if ($tile == constant::EMPTY) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return game winner (x/o) or no winner
     */
    public function winner($state)
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

    public function minimax($current_game_state, $player)
    {
        $_moves = new moves;
        $available_moves = array();

        if($this->winner($current_game_state) == constant::X)
        {

            $_moves->position = -1;
            $_moves->score = 10;
            return $_moves;
        }
        if($this->winner($current_game_state) == constant::O)
        {

            $_moves->position = -1;
            $_moves->score = -10;
            return $_moves;
        }
        if(!$this->has_moves($current_game_state))
        {
            $_moves->position = -1;
            $_moves->score = 0;
            return $_moves;
        }


        foreach ($current_game_state as $position => $tile)
        {
            if($tile == constant::EMPTY)
            {
                $current_game_state[$position] = $player;

                if($player == constant::X)
                {
                    $_moves = $this->minimax($current_game_state,constant::O);
                }
                else
                {
                    $_moves = $this->minimax($current_game_state,constant::X);
                }

                $_moves->position = $position;
                array_push($available_moves,$_moves);

                $current_game_state[$position] = constant::EMPTY;



            }
        }

        $best_move_position = -1;
        $score = -1;
        if($player == constant::X)
        {
            $score = PHP_INT_MIN;
            foreach ($available_moves as $position=>$this_move)
            {
                if($this_move->score > $score)
                {
                    $score = $this_move->score;
                    $best_move_position = $position;
                }
            }
        }

        if($player == constant::O)
        {
            $score = PHP_INT_MAX;
            foreach($available_moves as $position=>$this_move)
            {
                if($this_move->score < $score)
                {
                    $score = $this_move->score;
                    $best_move_position = $position;
                }
            }
        }
        return $available_moves[$best_move_position];

    }// END MINIMAX

    public function make_ai_move($game_state)
    {
        $this->set_game_state($game_state);
        //$ai_move = $this->minimax($game_state,constant::X);
        //$this->move($ai_move[1],constant::X);
    }

    public function print_state($state)
    {
        foreach ($state as $position=>$tile)
        {
            if($position % 3 == 0)
            {
                print "\n";
            }
            print "$tile ";
        }
    }

}// END OF CLASS AI






/*
 * TESTING ONLY
 *
 * $_ai = new AI();
$game_state = array(constant::EMPTY,constant::EMPTY,constant::EMPTY,constant::EMPTY,constant::EMPTY,constant::EMPTY,constant::EMPTY,constant::EMPTY,constant::EMPTY);
do{
    $_ai->print_state($game_state);
    print "Enter position (0-8): ";
    $position = readline("ENTER NUMBER");
    $game_state[$position] = constant::O;
    $move = $_ai->minimax($game_state, constant::X);
    $game_state[$move->position] = constant::X;
}while($_ai->has_moves($game_state) && $_ai->winner($game_state) == constant::NO_WINNER);
$_ai->print_state($game_state);
*/


