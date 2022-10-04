<?php 

require 'AbstractRequestValidator.php';
require dirname(__FILE__).'/../Constants.php';

class StartGameValidator extends AbstractRequestValidator {
    
    private static $mandatory_fields = [PLAYER_X_PARAM,PLAYER_O_PARAM];
    public function __construct()
    {
        //Configuration is provided to parent constructor
        parent::__construct(self::$mandatory_fields,[]);
    }

    protected function additionalChecks(array $request):string {
        if( $request[PLAYER_X_PARAM] && $request[PLAYER_O_PARAM] && $request[PLAYER_X_PARAM] == $request[PLAYER_O_PARAM])
            return 'You don\'t fool me! Players name must be different';
        return '';
    }

}