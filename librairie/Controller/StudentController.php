<?php
    namespace Controller;
    Class StudentController extends ControllerController{
        protected static $table_name = "Student";
        protected static $model_class = \Model\Student::class;
        protected static $database = "grds";

        public static function login($username, $password){
            return UserController::login($username, $password, self::$table_name);
        }
    }