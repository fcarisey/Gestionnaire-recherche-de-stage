<?php
    namespace Controller;
    Class AdminController extends UserController{
        protected static $table_name = "admin";
        protected static $model_class = \Model\Admin::class;
        protected static $database = "grds";

        // public static function login($username, $password){
        //     return UserController::login($username, $password, self::$table_name);
        // }
    }