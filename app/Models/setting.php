<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    use HasFactory;
    public static function compnay_logo()
    {

       $logo= setting::first();
         if(!empty($logo))
       {
             return $logo->logo;
       }
       else{
           return ' ';
       }
      
    }
    
       public static function compnay_name()
    {

       $logo= setting::first();
         if(!empty($logo))
       {
             return $logo->Company_Name;
       }
       else{
           return ' ';
       }
      
    }
    
        public static function compnay_favi()
    {

       $logo= setting::first();
         if(!empty($logo))
       {
             return $logo->favi_icon;
       }
       else{
           return ' ';
       }
      
    }
    
    
      public static function compnay_currency()
    {

       $logo= setting::first();
         if(!empty($logo))
       {
             return $logo->currency;
       }
       else{
           return ' ';
       }
      
    }
    
       public static function compnay_lang()
    {

       $lan= setting::first();
       if(!empty($lan))
       {
            return $lan->language;
       }
       else{
           return 'en';
       }
      
    }
    
      public static function date_farmate($datee){
          
          $date= setting::first();
         if(!empty($date))
       {
           $datew = strtotime($datee);
          // $string_date=addslashes($date->date_formate);
           // return $date->date_formate;
           $newformat =date($date->date_formate,$datew);
           return $newformat;

       }
       else{
           return $datee;
       }
    }
    
    public static function tax_amount($tax){
          
          $tax_ratio= setting::first();
         if(!empty($tax_ratio->tax_ratio))
       {
          
           $newformat =($tax/100)*$tax_ratio->tax_ratio;
           return $newformat;

       }
       else{
           return '0';
       }
    }
}
