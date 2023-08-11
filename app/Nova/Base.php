<?php
    namespace App\Nova;
    trait Base {


        public static function label()
        {
            return static::$labels[0];
        }
    

        public static function singularLabel()
        {
            return static::$labels[1];
        }
        
        public static function group()
        {
            return isset(static::$labels[2]) ? static::$labels[2] : static::$group;
        }
    }