#!/bin/bash

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
    \"player\":1,
    \"row\": \"0\",
    \"column\": \"0\",
    \"game_id\": \"$id\"
}" )
echo "Move is [0,0] by Mario"
echo "Response is $response "

response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
    \"player\":2,
    \"row\": \"0\",
    \"column\": \"1\",
    \"game_id\": \"$id\"
}")
echo "Move is [0,1] by Luigi"
echo "Response is $response "

response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
    \"player\":1,
    \"row\": \"0\",
    \"column\": \"2\",
    \"game_id\": \"$id\"
}")

echo "Move is [0,2] by Mario"
echo "Response is $response "

response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
    \"player\":2,
    \"row\": \"1\",
    \"column\": \"1\",
    \"game_id\": \"$id\"
}")
echo "Move is [1,1] by Luigi"
echo "Response is $response "


response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
    \"player\":1,
    \"row\": \"1\",
    \"column\": \"0\",
    \"game_id\": \"$id\"
}")
echo "Move is [1,0] by Mario"
echo "Response is $response "

response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
    \"player\":2,
    \"row\": \"1\",
    \"column\": \"2\",
    \"game_id\": \"$id\"
}")
echo "Move is [1,2] by Luigi"
echo "Response is $response "


response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
    \"player\":1,
    \"row\": \"2\",
    \"column\": \"1\",
    \"game_id\": \"$id\"
}")
echo "Move is [2,1] by Mario"
echo "Response is $response "

response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
    \"player\":2,
    \"row\": \"2\",
    \"column\": \"0\",
    \"game_id\": \"$id\"
}")
echo "Move is [2,0] by Luigi"
echo "Response is $response "


response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
    \"player\":1,
    \"row\": \"2\",
    \"column\": \"2\",
    \"game_id\": \"$id\"
}")
echo "Move is [2,2] by Mario"
echo "Response is $response "

response=$(curl --silent --location --request POST 'localhost/tic-tac-toe/move.php' \
--header 'Content-Type: application/json' \
--data-raw "{
    \"player\":2,
    \"row\": \"2\",
    \"column\": \"2\",
    \"game_id\": \"$id\"
}")
echo "Move is [2,2] but game has ended"
echo "Response is $response "

