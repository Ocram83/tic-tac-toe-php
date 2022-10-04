#!/bin/bash

response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/start-new-game.php' \
--header 'Content-Type: application/json' \
--data-raw '{
}' )
echo "Response is $response "


response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/start-new-game.php' \
--header 'Content-Type: application/json' \
--data-raw '{
        "player_x":"1"
}' )
echo "Response is $response "

response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/start-new-game.php' \
--header 'Content-Type: application/json' \
--data-raw '{
        "player_o":"1"
}' )
echo "Response is $response "


response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/start-new-game.php' \
--header 'Content-Type: application/json' \
--data-raw '{
    "player_x":"1",
    "player_o":"1"
}')

echo "Response is $response "


response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
    \"row\": \"100\",
    \"column\": \"-2\",
    \"game_id\": \"09342i0i4jifw \"
}" )
echo "Response is $response "


response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
    \"game_id\": \"09342i0i4jifw \"
}" )
echo "Response is $response "


response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
}" )
echo "Response is $response "


id=$(curl --silent --location --request POST 'localhost/tic-tac-toe/start-new-game.php' \
--header 'Content-Type: application/json' \
--data-raw '{
    "player_x":"Mario",
    "player_o":"Luigi"
}'| jq -r '.game_id')

echo "Game Id is "$id;

response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
    "player":"2",
    \"row\": \"0\",
    \"column\": \"0\",
    \"game_id\": \"$id\"
}" )
echo "Move is [0,0] by Mario"
echo "Response is $response "