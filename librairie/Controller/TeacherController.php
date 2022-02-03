<?php
    namespace Controller;
    Class TeacherController extends ControllerController{
        protected static $table_name = "Teacher";
        protected static $model_class = \Model\Teacher::class;
        protected static $database = "grds";

        public static function login($username, $password){
            return UserController::login($username, $password, self::$table_name);
        }
    }