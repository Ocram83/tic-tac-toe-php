<?php
header('Content-Type: application/json; charset=utf-8');

require_once '../../vendor/autoload.php';
require '../../tic-tac-toe/validators/StartGameValidator.php';
require '../../tic-tac-toe/Constants.php';
require '../../tic-tac-toe/repositories/GameRepository.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $params = json_decode(file_get_contents('php://input'), true);

    $response = [];

    if(!$params)
    {
        $response['ErrorMessage'] = "Missing body request!";
        echo json_encode($response);
        http_response_code(422);
    }
    $validator = new StartGameValidator();
    try{
        $validator->validateRequest($params);
        $gameID = $UUID = vsprintf( '%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4) );

        $response["game_id"] = $gameID;
        $response["player_turn"] = 1;

        $newGame = new GameModel($gameID,$params);
        $repository = new GameRepository();
        $repository->saveOrUpdateGame($newGame);

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