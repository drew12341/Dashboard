<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_period')) {
    function month_to_period($month)
    {
        switch(intval($month)){
            case 2:
            case 3:
                $period = 1;
                break;
            case 4:
            case 5:
                $period = 2;
                break;
            case 6:
            case 7:
                $period = 3;
                break;
            case 8:
            case 9:
                $period = 4;
                break;
            case 10:
            case 11:
                $period = 5;
                break;
            case 12:
            case 1:
                $period = 6;
                break;

        }
        return $period;
    }
}

