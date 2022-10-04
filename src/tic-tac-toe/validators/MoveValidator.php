<?php 

require 'AbstractRequestValidator.php';
require  dirname(__FILE__).'/../Constants.php';

class MoveValidator extends AbstractRequestValidator {
    
    private static $mandatory_fields = [PLAYER_PARAM,MOVE_PARAM_ROW,MOVE_PARAM_COLUMN, GAME_ID_PARAM];
    private static $fixed_domain_field = [
        PLAYER_PARAM => ["type" => "range",  "values" => [1, 2], "label" => "player"],
        MOVE_PARAM_ROW => ["type" => "range",  "values" => [0, 2], "label" => "row"],
        MOVE_PARAM_COLUMN => ["type" => "range",  "values" => [0, 2], "label" => "column"]

    ];

    public function __construct()
    {
        //Configuration is provided to parent constructor
        parent::__construct(self::$mandatory_fields, self::$fixed_domain_field);
    }

}