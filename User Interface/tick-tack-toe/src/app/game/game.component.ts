import { Component, OnInit } from '@angular/core';
import {GameService} from '../game.service';

@Component({
  selector: 'app-game',
  templateUrl: './game.component.html',
  styleUrls: ['./game.component.css']
})

export class GameComponent implements OnInit {
  // lockCLick = false;

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
