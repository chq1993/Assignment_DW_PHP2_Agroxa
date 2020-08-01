<?php
 namespace App\Facade;

 use Illuminate\Support\Facades\Facade;

 class HelperFacade extends Facade
 {
     /**
      * @return string
      */
    protected static function getFacadeAccessor()
    {
        return 'Helper';
    }

 }
