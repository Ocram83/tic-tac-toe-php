<?php

require_once dirname(__FILE__).'/../models/GameModel.php';
require_once '../../vendor/autoload.php';
require dirname(__FILE__).'/../Constants.php';


interface IGameRepository
{
    public function loadGame(string $gameId): GameModel;
    public function saveOrUpdateGame(GameModel $game);
}

class GameRepository implements IGameRepository
{
    private Predis\Client $client;

    public function __construct()
    {
        $this->client = new Predis\Client('tcp://redis:6379');

    }
    public function loadGame(string $gameId):GameModel{

        $game = $this->client->hgetall($gameId);

        if(empty($game)) throw new Exception("No game defined for such id");

        return new GameModel($gameId,$game);
    }
    public function saveOrUpdateGame(GameModel $game)
    {
        $this->client->hset($game->gameId, PLAYER_X_PARAM, $game->player_x);
        $this->client->hset($game->gameId, PLAYER_O_PARAM, $game->player_o);
        $this->client->hset($game->gameId, REDIS_PLAYER_TURN,$game->turn);
        $this->client->hset($game->gameId, REDIS_STATUS_PARAM,$game->status);
        $this->client->hset($game->gameId, REDIS_NUMBER_OF_MOVES,$game->number_of_moves);
        $this->client->hset($game->gameId, REDIS_GRID, json_encode($game->grid));
        $this->client->hset($game->gameId, REDIS_WINNER, $game->winner);

    }
}