<?php
    namespace Controller;
    Class InternshipController extends ControllerController{
        protected static $table_name = "Internship";
        protected static $model_class = \Model\Internship::class;
        protected static $database = "grds";
    }