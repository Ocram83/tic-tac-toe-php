# tic-tac-toe-php
This is an example of how to implement tic tac toe game in plain php

## Start a game
Post request to localhost/tic-tac-toe/start-new-game.php

` curl --location --request POST 'localhost/tic-tac-toe/start-new-game.php' \
--header 'Content-Type: application/json' \
--data-raw '{
    "player_x":"Mario",
    "player_o":"Luigi"
}'`

The 2 parameters player_x and player_o are mandatory.
Here is an example response

`{
    "game_id": "cf368253-503b-7b7d-0dad-0b9d4e71e1ac",
    "player_turn": "Mario"
}`

## Play a game
Post request to localhost/tic-tac-toe/move.php

`curl --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw '{
    "row":0,
    "column":0,
    "game_id":"cf368253-503b-7b7d-0dad-0b9d4e71e1ac"
}'`

Parameter `game_id` identifies the game, parameter `row` and `column` are the coordinate on the grid which the current player want to select. Valid coordinates ranges from `0` to `2`.

Here is an example response

`{
    "player_x": "Marco",
    "player_0": "Ciccio",
    "player_turn": "Marco",
    "grid": [
        [
            "X",
            "-",
            "-"
        ],
        [
            "-",
            "-",
            "-"
        ],
        [
            "-",
            "-",
            "-"
        ]
    ]
}`

On the grid, positions occupied by symbol `-` are non taken positions.

## Examples

run `sh` scripts in root folder to test few api interactions.

