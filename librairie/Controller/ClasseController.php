<?php
    namespace Controller;
    Class ClasseController extends ControllerController{
        protected static $table_name = "Classe";
        protected static $model_class = \Model\Classe::class;
        protected static $database = "grds";
    }