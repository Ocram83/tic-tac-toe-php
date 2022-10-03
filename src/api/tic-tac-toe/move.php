<?php
header('Content-Type: application/json; charset=utf-8');

require_once '../../vendor/autoload.php';
require '../../tic-tac-toe/validators/MoveValidator.php';
require '../../tic-tac-toe/Constants.php';
require '../../tic-tac-toe/repositories/GameRepository.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $params = json_decode(file_get_contents('php://input'), true);
    $response = [];
    $validator = new MoveValidator();
    try{
        $validator->validateRequest($params);
        
        $repository = new GameRepository();

        $game = $repository->loadGame($params[GAME_ID_PARAM]);

        if($game->status > 0 )
            throw new Exception("This game is over!");


        $game->makeAMove($params[MOVE_PARAM_ROW],$params[MOVE_PARAM_COLUMN]);
        $repository->saveOrUpdateGame($game);
        $response['player_x'] = $game->player_x;
        $response['player_0'] = $game->player_o;
        $response['player_turn'] = $game->turn;
        $response['grid'] = $game->grid;
        switch($game->status){
            case 1:
                $response['message'] = "{$game->winner} won this game! Congrats!";
                break;
            case 2:
                $response['message']= "The game ended in a draw";
                break;
            default:
                break;
        }

   
       
        http_response_code(200);
    }
    catch(Exception $e){
        $response['ErrorMessage'] =$e->getMessage();
        http_response_code(422);

    }
    echo json_encode($response);
} else {
    http_response_code(405);
}