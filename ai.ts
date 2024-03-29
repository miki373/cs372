/*

THIS FILE HOLDS : AI , CheckWinner

QUICK HOW TO USE:
    check for winner:
        var winner = new CheckWinner(state).returnWinner();
    check if there are available moves:
        var winner = new CheckWinner(state).hasMoves();
    make ai move:
        var aiMove = new AI(state, ai_sigh).getMove();


For more details look at comments surrounding the class you need help with.
If you have any specific question, email me at ovcina2m@uregina.ca or text me at 306 591 1260..


 */






/* change this to match your empty square constant*/
const empty = null;
// change or use this value as no winner
const no_winner = "nowinner";
// Variable for x
const X = 'X';
// Constatnt for y
const O = 'O';
// [0,  1,  2,  3,  4,  5,  6,  7,  8]
//var d2 = [Y, X, Y, Y, X, Y, empty, empty, X];


/*
BEGIN CheckWinner CLASS
Parameters
state = game state as array of 8 strings in form of [X,O,X,O,X,X,null,null];

USE INSTRUCTIONS:
    Initiation:
    var checkGame = new CheckWinner(state);

    Checking for winner:
    var winner = CheckWinner.returnWinner();

    Return:
    Function will return sign of the winning player [X,O] or nowinner
    To alter this behaviour, change no_winner variable

    Checking if there are available moves:
    var moves = checkGame.hasMoves();

    Return:
    Function will return true if there are empty tiles still in game, false otherwise.

    ALTERNATIVE
    var winner = new returnWinner(state).returnWinner();
    var moves = new returnWinner(state).hasMoves();

*/
class CheckWinner
{
    // holds array of current game state
    state: string[];

    // constructor
    constructor(game_state: string[])
    {
        this.state = game_state;
    }

    // return true if there exists at least one tile that is empty
    // otherwise, return false...
    // TO CHANGE WHAT IS RETURNED< CHANGE return true/false TO WHATEVER YOU NEED
    hasMoves()
    {
        for (let i of this.state)
        {
            if (i == empty)
            {
                return true;
            }
        }
        return false;
    }
    // returns sign of winner. If, for example, X has 3 tiles in any winnin position, X will be returned
    // If there is no winning combination or a draw, nowinner will be returned..
    // TO CHANGE WHAT IS RETURNED< CHANGE no_winner VARIABLE //
    returnWinner()
    {


        /*
          _______
         |x x x|
         |     |
         |_____|
         */
        if ((this.state[0] != empty) && (this.state[0] == this.state[1]) && (this.state[1] == this.state[2]) && (this.state[0] == this.state[2]))
        {
            return this.state[0];
        }

        /*
       _______
       |     |
       |x x x|
       |_____|
       */
        if(this.state[3] != empty && (this.state[3] == this.state[4]) && (this.state[4] == this.state[5]) && (this.state[5] == this.state[3]))
        {
            return this.state[3];
        }

        /*
         _______
        |     |
        |     |
        |x x x|
       */
        if(this.state[6] != empty && (this.state[6] == this.state[7]) && (this.state[7] == this.state[8]) && (this.state[8] == this.state[6]))
        {
            return this.state[6];
        }

        /*
        _______
        |x    |
        |x    |
        |x____|
        */
        if(this.state[0] != empty && (this.state[0] == this.state[3]) && (this.state[3] == this.state[6]) && (this.state[6] == this.state[0]))
        {
            return this.state[0];
        }

        /*
      _______
      |  x  |
      |  x  |
      |__x__|
      */
        if(this.state[1] != empty && (this.state[1] == this.state[4]) && (this.state[4] == this.state[7]) && (this.state[7] == this.state[1]))
        {
            return this.state[1];
        }

        /*
         _______
         |    x|
         |    x|
         |____x|
         */
        if(this.state[2] != empty && (this.state[2] == this.state[5]) && (this.state[5] == this.state[8]) && (this.state[8] == this.state[2]))
        {
            return this.state[2];
        }

        /*
       _______
       |x    |
       |  x  |
       |____x|
       */
        if(this.state[0] != empty && (this.state[0] == this.state[4]) && (this.state[4] == this.state[8]) && (this.state[8] == this.state[0]))
        {
            return this.state[0];
        }

        /*
        _______
        |    x|
        |  x  |
        |x____|
        */
        if(this.state[2] != empty && (this.state[2] == this.state[4]) && (this.state[4] == this.state[6]) && (this.state[6] == this.state[2]))
        {
            return this.state[2];
        }

        // if at this point, there is no winner, return no winner
        return no_winner;
    }

}


/*
BEGIN AI CLASS
Note* This class depends on CheckWinner class and will not function without it...

Parameters:
state = game state as array of 8 strings in form of [X,O,X,O,X,X,null,null];
move = turn as string that is either X or O

USE INSTRUCTIONS:
    Initiation:
    var ai = new AI(state, move);

    Returning ai move:
    var move = ai.getMove(); // move variable will hold value from 0 to 8 corresponding to ai move

    ALTERNATIVE
    var move = new AI(stete, move).getMove();

Return:
    AI(stete, move).getMove() will return integer in domain [0,8]. This integer corresponds to empty tile in tic tac toe
    game. Use this value to populate that tile along with sign (X,O) of AI player.
*/
class AI
{
    private state: string[];
    private initturn: string;
    private position: number;
    private score: number;
    private aisign: string;
    private humansign: string;
    private Nmove: number;
    constructor(game_state: string[], turn:string)
    {
        this.state = game_state;
        this.initturn = turn;
        this.score = 1;
        this.position = 0;
        this.aisign = this.initturn;
        this.Nmove = 1;
        if (this.aisign == X){
            this.humansign = O;
        } else {
            this.humansign = X;
        }
    }

    getMove()
    {


        if (this.isFirstNMoves() <= this.Nmove)
        {
            let firstTwoMoves = this.assignFirstNMoves();
            if (firstTwoMoves != -1)
            {
                return firstTwoMoves;
            }
        }
        // After this AI takes over
        var bestMove = this.minimax(this.state ,this.initturn);
        return bestMove[this.position];

    }
    private minimax(state:string[], player:string)
    {
        // Hold alailabe moves at each level of recursion
        // move val is a 2d array with first index [x][] pointing to moves array
        // all_moves array holds position and score of move
        // structure looks like this
        // move_val[][] = {all_moves, all_moves .... };
        // all_moves[] = {position = x, score  = x};
        // Combined view
        // {{position = x, score = x} ,{position = x, score = x} .... }
        var move_val: number[] = new Array(2);
        var all_moves: number[][] = new Array();

        // Check the state of game
        var move_state = new CheckWinner(state);
        var winner = move_state.returnWinner();
        var moves = move_state.hasMoves();

        // Begin base case

        // If its my turn and I worn, return +10, position do not care
        if (winner == this.aisign){
            //move_val[this.position] = -1;
            move_val[this.score] = 10;
            return move_val;
        }
        // If opponenets turn and they won, return -10, position do not care
        if (winner == this.humansign){
            //move_val[this.position] = -1;
            move_val[this.score] = -10;
            return move_val;
        }
        // If there are no more moves and no winners, return 0, position do not care
        if (!moves){
            //move_val[this.position] = -1;
            move_val[this.score] = 0;
            return move_val;
        }


        // End base case
        // Begin recursive case
        // For each available move
        //      block <- mysign
        //      myturn = opposite player
        //      move_val <- minimax(state, myturn)
        //      block <- free
        //      all_moves <- move_val
        for (var i = 0; i < state.length; i++){
            if (state[i] == empty){
                state[i] = player;
                if (player == X){
                    move_val = minimax(state, O);
                }
                else{
                    move_val = minimax(state, X);
                }

                move_val[this.position] = i;
                state[i] = empty;

                // push new move into array
                all_moves.push(move_val);
            }
        }

        var best_move_pos = -1;
        var temp_score;

        if (player == O) {
            temp_score = 10000;
            for (var i = 0; i < all_moves.length; i++) {
                if (all_moves[i][this.score] < temp_score)
                {
                    temp_score = all_moves[i][this.score];
                    best_move_pos = i;
                }
            }
        }

        if (player == X){
            temp_score = -10000;
            for (var i = 0; i < all_moves.length; i++){
                if (all_moves[i][this.score] > temp_score){
                    temp_score = all_moves[i][this.score];
                    best_move_pos = i;
                }
            }
        }
        return all_moves[best_move_pos];
    }

    // Return number of assigned tiles
    private isFirstNMoves()
    {
        let numMoves = 0;
        for (let i of this.state)
        {
            if (i != empty)
            {
                numMoves++;
            }
        }
        return numMoves;
    }

    //THIS FUNCTION REMOVES TIME COMPLEXITY OF FRIST TWO MOVES
    // Assignm firs 1 to 2 moves using "hierarchical" array of prefered moves
    // Algorithm:
    // Try to assign center tile if it is free, else assign one of the corners
    private assignFirstNMoves()
    {
        var possibles = [4, 0, 2, 8, 6];
        for (let i = 0; i < possibles.length; i++)
        {
            if (this.state[possibles[i]] == empty)
            {
                return possibles[i];
            }
        }
        // if for some reason execution ges here return -1
        return -1;
    }

}
