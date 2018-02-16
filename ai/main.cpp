#include <iostream>
#include <string>
#include <vector>
#define WIDTH 3
#define SIZE 9
#define O 0
#define X 1
#define EMPTY -1
#define NOWINNER 100
#define NOMOVES -100

using namespace std;

struct moves
{
	int score;
	int position;
};

void print(int*);
void init(int*);
bool move(int *, int, int);
int win(int *);
bool available_moves(int*);
moves minimax(int*, int);


int main()
{
	int tic_tac[SIZE]; 
	init(tic_tac);

	
	
	
	int x, y;
	bool correct_user_in;
	moves ai_move;
	while (available_moves(tic_tac) && win(tic_tac) == NOWINNER)
	{
		print(tic_tac);
		do
		{
			cout << "\nHuman player turn" << endl;
			cout << "X: "; cin >> x;
			cout << "Y: "; cin >> y;
			correct_user_in = move(tic_tac, (y * WIDTH) + x, O);
		} while (!correct_user_in);
		if (win(tic_tac) != NOWINNER || !available_moves(tic_tac))
		{
			break;
		}
		cout << "\nAI move.\n";
		ai_move = minimax(tic_tac, X);
		move(tic_tac, ai_move.position, X);

	
	}

	switch (win(tic_tac))
	{
	case X: cout << "AI WON!\n"; break;
	case O: cout << "HUMAN WON!\n"; break;
	case -1: cout << "NO MORE MOVES\n"; break;
	default:
		break;
	}
	print(tic_tac);
	
	

}

void init(int * game)
{
	for (int i = 0; i < SIZE; i++)
	{
		game[i] = EMPTY;
	}
}
void print(int * game)
{
	cout << " -------------\n";
	for (int i = 0; i < SIZE; i++)
	{
		
		if (i % WIDTH == 0 && i != 0)
		{
			cout << " | ";
			cout << endl;
			cout << " -------------\n";
		}
		if (game[i] == EMPTY)
		{
			cout << " |  ";
		}
		else
		{
			cout <<" | " <<game[i];
		}
		
	}
	cout << " | \n";
	cout << " -------------\n";
}
bool move(int * game,int position ,int player)
{
	if (player == O)
	{
		if (game[position] == EMPTY)
		{
			game[position] = player;
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		game[position] = player;
	}
		
		
	
}
int win(int * game)
{

	// For each position, check if there is a winner
	// ROW 0
	if (game[0] != EMPTY && game[0] == game[1] && game[1] == game[2] && game[0] == game[2])
	{
		return game[0];
	}
	// ROW 1
	else if ((game[3] != EMPTY) && game[3] == game[4] && game[4] == game[5] && game[3] == game[5])
	{
		return game[3];
	}
	// WOR 2
	else if (game[6] != EMPTY && game[6] == game[7] && game[7] == game[8] && game[6] == game[8])
	{
		return game[6];
	}
	// COL 0
	else if (game[0] != EMPTY && game[0] == game[3] && game[3] == game[6] && game[0] == game[6])
	{
		return game[0];
	}
	// COL 1
	else if (game[1] != EMPTY && game[1] == game[4] && game[4] == game[7] && game[1] == game[7])
	{
		return game[1];
	}
	// COL 2
	else if (game[2] != EMPTY && game[2] == game[5] && game[5] == game[8] && game[2] == game[8])
	{
		return game[2];
	}
	// DIAG 0 to 8
	else if (game[0] != EMPTY && game[0] == game[4] && game[4] == game[8] && game[0] == game[8])
	{
		return game[0];
	}
	// DIAG 2 to 6
	else if (game[2] != EMPTY && game[2] == game[4] && game[4] == game[6] && game[2] == game[6])
	{
		return game[2];
	}
	else {
		return NOWINNER;
	}
	
}
moves minimax(int* game, int player)
{
	moves this_move;
	vector<moves> game_moves;
	// BASE CASE
	// X has won
	if (win(game) == X)
	{
		this_move.score = 10;
		return this_move;
	}
	// O has won
	if (win(game) == O)
	{
		this_move.score = -10;
		return this_move;
	}
	// No more moves
	if (!available_moves(game))
	{
		this_move.score = 0;
		return this_move;
	}
	// END BASE CASE


	// BEGIN RECURSION
	for (int i = 0; i < SIZE; i++)
	{
		if (game[i] == EMPTY)
		{
			move(game, i, player);
			if (player == X)
				this_move = minimax(game, O);
			else
				this_move = minimax(game, X);
			this_move.position = i;
			game_moves.push_back(this_move);
			move(game, i, EMPTY);
		}
	}
	
	int move;
	int score;
	if (player == X)
	{
		score = INT_MIN;
		for (unsigned int i = 0; i < game_moves.size(); i++)
		{
			if (game_moves[i].score > score)
			{
				score = game_moves[i].score;
				move = i;
			}
		}
	}

	if (player == O)
	{
		score = INT_MAX;
		for (unsigned int i = 0; i < game_moves.size(); i++)
		{
			if (game_moves[i].score < score)
			{
				score = game_moves[i].score;
				move = i;
			}
		}
	}
	return game_moves[move];
}


bool available_moves(int* game)
{
	for (int i = 0; i < SIZE; i++)
	{
		if (game[i] == EMPTY)
		{
			return true;
		}
	}
	return false;
}