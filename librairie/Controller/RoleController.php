<?php
    namespace Controller;
    Class RoleController extends ControllerController{
        protected static $table_name = "Role";
        protected static $model_class = \Model\Role::class;
        protected static $database = "grds";
    }