<?php
require dirname(__FILE__).'/../Constants.php';

class GameModel
{
    public string $gameId;
    public string $player_x;
    public string $player_o;
    public string $turn;
    public array $grid = [];
    public string $status;
    public int $number_of_moves;
    public int $gridSize;

    public string $winner;
    public array $diagonalPositions;

    
    public function __construct(string $gameId, array $params, int $gridSize=3)
    {
        $this->gridSize = $gridSize;
        $this->gameId = $gameId;
        $this->player_x = $params[PLAYER_X_PARAM];
        $this->player_o = $params[PLAYER_O_PARAM];
        $this->turn = $params[REDIS_PLAYER_TURN]??$params[PLAYER_X_PARAM];
        $this->number_of_moves = $params[REDIS_NUMBER_OF_MOVES]??0;
        $this->status = $params[REDIS_STATUS_PARAM]??0;
        $this->winner = $params[REDIS_WINNER]??'';
        if($params[REDIS_GRID]) {
            $this->grid = json_decode($params[REDIS_GRID]);
        }
        else {
            foreach(range(0,($this->gridSize - 1)) as $pos){
                $this->grid[] = [...str_split(str_repeat('-',$gridSize))];
            }
        }
    }

    public function makeAMove(int $rowNum, int $columnNum){
        
        if($this->grid[$rowNum][$columnNum] == '-')
            $this->grid[$rowNum][$columnNum] = $this->getPlayerSign();
        else
            throw new Exception('Don\'t you dare cheating, the position is already taken!');
        
        $this->number_of_moves++;

        if($this->checkWinningMove($rowNum,$columnNum)){
            $this->winner = $this->turn;
            $this->status=1;
       }
       else if($this->number_of_moves == $this->gridSize*$this->gridSize)
       {
        $this->status = 2; 
       }
       $this->turn = $this->getNextPlayer();
        
    }
    private function getPlayerSign(){
        if(strcmp($this->turn,$this->player_x) == 0)
            return "x";
        return "o";
    }

    private function getNextPlayer(){
        if(strcmp($this->turn,$this->player_x) == 0)
            return $this->player_o;
        return $this->player_x;
    }

    private function checkWinningMove(int $rowNum, int $columnNum): bool {
        if( $this->checkHorizontalWinningMove($rowNum) ||
            $this->checkVerticalWinningMove($columnNum) ||
            $this->checkDiagonalWinningMove($rowNum,$columnNum))
            return true;
        return false;
    }

    private function checkHorizontalWinningMove(int $rowNum): bool {
        return strcmp(implode($this->grid[$rowNum]),str_repeat($this->getPlayerSign(),$this->gridSize)) == 0;
    }

    private function checkVerticalWinningMove(int $columnNum): bool{
        return strcmp(implode(array_column($this->grid,$columnNum)),str_repeat($this->getPlayerSign(),$this->gridSize)) == 0;
    }
    
    private function checkDiagonalWinningMove(int $rowNum, int $columnNum): bool{
        if($rowNum == $columnNum)
        {
            $diag = '';
            foreach(range(0,($this->gridSize-1)) as $pos){
                $diag .= $this->grid[$pos][$pos];
            }
            return strcmp($diag,str_repeat($this->getPlayerSign(),$this->gridSize)) == 0;
        }
        if($rowNum + $columnNum == (($this->gridSize-1)))
        {
            $diag = '';
            foreach(range(0,($this->gridSize-1)) as $pos){
                $diag .= $this->grid[$pos][($this->gridSize-1)-$pos];
            }
            return strcmp($diag,str_repeat($this->getPlayerSign(),$this->gridSize)) == 0;
        }
        return false;
    }
}