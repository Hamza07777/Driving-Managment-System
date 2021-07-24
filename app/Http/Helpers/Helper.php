<?php
namespace App\Helpers;
class Helper
{
    function date_farmate(){
        return 'hello';
    }
    public static function instance()
      {
        return new AppHelper();
        }
}