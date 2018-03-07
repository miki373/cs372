import { Injectable } from '@angular/core';
import { Block } from './block';
import {Player} from './player';

@Injectable()
export class GameService {

  players = [];
  turn = 0; // By default value will be 0 (player 1 turn)
  draw = 0;
  blocks = [];
  freeBlocksRemaining = 9; // because 9 spaces

  constructor() {
    this.initializeBlocks();
    this.initializePlayers();
  }

  initializeBlocks() {

    for ( let i = 0; i < 9; i++) {
        const block = new Block();
        block.free = true;
        block.value = '';
        block.symbol = '';

        this.blocks.push(block);
    }
  }

  initializePlayers() {
    // player 1
    const player1 = new Player();
    player1.bot = false;

    // player 2
    const player2 = new Player();

    this.players.push(player1);
    this.players.push(player2);
  }
  changeTurn() {
    if ( this.turn === 0 ) {
      this.turn = 1;
    } else {
      this.turn = 0;
    }
  }
}
