<?php
    namespace Controller;
    Class CurrentinternshipController extends ControllerController{
        protected static $table_name = "currentinternship";
        protected static $model_class = \Model\Currentinternship::class;
        protected static $database = "grds";
    }