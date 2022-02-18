<?php
    namespace Controller;
    Class TeacherController extends UserController{
        protected static $table_name = "teacher";
        protected static $model_class = \Model\Teacher::class;
        protected static $database = "grds";

        // public static function login($username, $password){
        //     return UserController::login($username, $password, self::$table_name);
        // }
    }