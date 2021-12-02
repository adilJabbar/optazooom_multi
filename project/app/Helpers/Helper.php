<?php
use ourcodeworld\NameThatColor\ColorInterpreter;
class Helper 
{
    public static function applyClass($user) {
        return "call from helper to " . $user;
    }

    public static function get_color_name($hex)
    {

        $instance = new ColorInterpreter();

        $result = $instance->name($hex);
           
        return $result;
        
    }

}