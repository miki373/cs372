import { Component, OnInit } from '@angular/core';
import {GameService} from '../game.service';

@Component({
  selector: 'app-game',
  templateUrl: './game.component.html',
  styleUrls: ['./game.component.css']
})

export class GameComponent implements OnInit {
  // lockCLick = false;
  dataSource = PLAYER_DATA;
  columnsToDisplay = ['username', 'win', 'draw'];
  constructor( public gameService: GameService ) {}
  // newGame() {
  //   this.gameService.freeBlocksRemaining = 9;
  //   this.gameService.initializeBlocks();
  //   this.lockCLick = false;
  //   this.gameService.turn = 0;
  // }
  ngOnInit() {

  }

  resetGame(event) {
    location.reload();
    event.preventDefault();
  }

  playerClick(position: number) {

    // if (this.gameService.blocks[position].free === false || this.lockCLick === true ){
    //   return; // Don't do anything
    // }
    // this.gameService.freeBlocksRemaining -= 1;
    //
    // if (this.gameService.freeBlocksRemaining === 0) {
    //   this.lockCLick = true;
    //   this.gameService.draw += 1;
    //   this.newGame();
    //   return;
    // }
    if (this.gameService.turn === 0) {
      this.gameService.blocks[position].setValue('cross');
    } else {
      this.gameService.blocks[position].setValue('circle');
    }
    this.gameService.changeTurn();
  }
}

export interface Player {
  username: string;
  win: number;
  lose: number;
  draw: number;
  totalGames: number;
  bot: boolean;
}

const PLAYER_DATA: Player[] = [
  {username: 'Marioandres717', win: 5, lose: 9, draw: 11, totalGames: 25, bot: false},
  {username: 'CREATION', win: 10, lose: 1, draw: 0, totalGames: 11, bot: false},
  {username: 'anonymous', win: 99, lose: 45, draw: 50, totalGames: 194, bot: false},
  {username: 'Alarakis', win: 15, lose: 20, draw: 10, totalGames: 45, bot: false},
];

