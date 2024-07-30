<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('month_to_period')) {
    function month_to_period($month)
    {
        if($month > 1){
            return $month - 1;
        }
        return 12;
        //return intval($month);
        /*
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
        */
    }
}


if ( ! function_exists('year_to_period')) {
    function year_to_period($month)
    {
        if ($month > 1) {
            return date("Y");
        }

        return date("Y") - 1;

    }
}
