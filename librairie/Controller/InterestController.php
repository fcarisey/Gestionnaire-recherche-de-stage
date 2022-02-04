<?php
    namespace Controller;
    Class InterestController extends ControllerController{
        protected static $table_name = "interest";
        protected static $model_class = \Model\Interest::class;
        protected static $database = "grds";
    }