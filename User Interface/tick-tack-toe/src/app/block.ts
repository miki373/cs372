export class Block {
  free = true;
  value: string;   // Which user
  symbol: string; // X || O

  setValue(value) {
    this.value = value;

    if (this.value === 'cross') {
        this.symbol = 'X';
    } else {
      this.symbol = 'O';
    }
  }
}
