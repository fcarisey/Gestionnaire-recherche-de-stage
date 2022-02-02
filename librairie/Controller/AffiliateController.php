<?php
    namespace Controller;
    Class AffiliateController extends ControllerController{
        protected static $table_name = "Affiliate";
        protected static $model_class = \Model\Affiliate::class;
        protected static $database = "grds";
    }