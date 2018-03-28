import { Component, OnInit } from '@angular/core';
import {AiService} from '../../game/ai.service';

@Component({
  selector: 'app-ai-board',
  templateUrl: './ai-board.component.html',
  styleUrls: ['./ai-board.component.css']
})
export class AiBoardComponent implements OnInit {
  blocks: string[];
  playerSymbol = 'O';
  aiMove: number;
  constructor(private aiService: AiService) { }

  ngOnInit() {
    this.blocks = this.aiService.state;
    console.log(this.blocks);
  }

  onPlayerClick(position: number) {
    this.blocks[position] = this.playerSymbol;
    this.aiService.state = this.blocks;
    // CHECK IF THERE ARE AVAILABLE MOVES OR WINNERS AFTER HOMAN MAKES A MOVE
    

                    if(this.aiService.CheckWinner(this.blocks).hasMoves() == false)
                    {
                      // DO SOMETHING TO DISPLAY DRAW
                    }

                    if(this.aiService.CheckWinner(this.blocks) != "nowinner")
                    {
                      // DO SOMETHING TO DISPLAY HUMAN WON
                    }
    
    
    // END CHECK IF HUMAN WON OR HUMAN HAD LAST MOVE
    
    this.aiService.aisign = 'X';
    this.aiService.humansign = 'O';
    this.aiMove = this.aiService.minimax(this.blocks,'X');
    console.log(this.aiMove);
    this.blocks[this.aiMove[0]] = 'X';
    // CHECK IF THERE ARE AVAILABLE MOVES OR WINNERS AFTER AI MAKES A MOVE
    
    
                if(this.aiService.CheckWinner(this.blocks).hasMoves() == false)
                {
                  // DO SOMETHING TO DISPLAY DRAW
                }

                if(this.aiService.CheckWinner(this.blocks) != "nowinner")
                {
                  // DO SOMETHING TO AI WON
                }
    
    // END CHECK IF AI WON OR AI HAD LAST MOVE
    
  }

}
