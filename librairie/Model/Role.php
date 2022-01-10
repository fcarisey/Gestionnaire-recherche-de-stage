<?php
    namespace Model;
    Class Role{
        private $IdRole,$Designation;

        public function __construct($IdRole = null,$Designation = null){
           $this->setIdRole($IdRole)->setDesignation($Designation);
        }

        
        public function setIdRole($IdRole){
            $this->IdRole = $IdRole;
            return $this;
        }
        public function getIdRole(){
            return $this->IdRole;
        }

        public function setDesignation($Designation){
            $this->Designation = $Designation;
            return $this;
        }
        public function getDesignation(){
            return $this->Designation;
        }

        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $IdRole = \Controller\ControllerController::keyExist('IdRole', $d);
                    $Designation = \Controller\ControllerController::keyExist('Designation', $d);
                    $role = new self($IdRole,$Designation);

                    array_push($objs, $role);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }