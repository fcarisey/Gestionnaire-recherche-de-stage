<?php
    namespace Model;
    Class Internship{
        private $IdInternship,$Designation,$Description,$Website,$Enterprise,$Author,$Email,$Phone;

        public function __construct($IdInternship = null,$Designation = null,$Description = null,$Website = null,$Enterprise = null,$Author = null,$Email = null,$Phone = null){
           $this->setIdInternship($IdInternship)->setDesignation($Designation)->setDescription($Description)->setWebsite($Website)->setEnterprise($Enterprise)->setAuthor($Author)->setEmail($Email)->setPhone($Phone);
        }

        
        public function setIdInternship($IdInternship){
            $this->IdInternship = $IdInternship;
            return $this;
        }
        public function getIdInternship(){
            return $this->IdInternship;
        }

        public function setDesignation($Designation){
            $this->Designation = $Designation;
            return $this;
        }
        public function getDesignation(){
            return $this->Designation;
        }

        public function setDescription($Description){
            $this->Description = $Description;
            return $this;
        }
        public function getDescription(){
            return $this->Description;
        }

        public function setWebsite($Website){
            $this->Website = $Website;
            return $this;
        }
        public function getWebsite(){
            return $this->Website;
        }

        public function setEnterprise($Enterprise){
            $this->Enterprise = $Enterprise;
            return $this;
        }
        public function getEnterprise(){
            return $this->Enterprise;
        }

        public function setAuthor($Author){
            $this->Author = $Author;
            return $this;
        }
        public function getAuthor(){
            return $this->Author;
        }

        public function setEmail($Email){
            $this->Email = $Email;
            return $this;
        }
        public function getEmail(){
            return $this->Email;
        }

        public function setPhone($Phone){
            $this->Phone = $Phone;
            return $this;
        }
        public function getPhone(){
            return $this->Phone;
        }

        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $IdInternship = \Controller\ControllerController::keyExist('IdInternship', $d);
                    $Designation = \Controller\ControllerController::keyExist('Designation', $d);
                    $Description = \Controller\ControllerController::keyExist('Description', $d);
                    $Website = \Controller\ControllerController::keyExist('Website', $d);
                    $Enterprise = \Controller\ControllerController::keyExist('Enterprise', $d);
                    $Author = \Controller\ControllerController::keyExist('Author', $d);
                    $Email = \Controller\ControllerController::keyExist('Email', $d);
                    $Phone = \Controller\ControllerController::keyExist('Phone', $d);
                    $internship = new self($IdInternship,$Designation,$Description,$Website,$Enterprise,$Author,$Email,$Phone);

                    array_push($objs, $internship);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }