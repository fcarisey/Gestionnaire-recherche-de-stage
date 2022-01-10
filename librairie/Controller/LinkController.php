<?php
    namespace Controller;
    Class LinkController extends ControllerController{
        protected static $table_name = "Link";
        protected static $model_class = \Model\Link::class;
        protected static $database = "grds";
    }