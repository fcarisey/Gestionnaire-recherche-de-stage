<?php
    namespace Model;
    Class Currentinternship{
        private $idcurrentinternship,$designation,$description,$website,$enterprise,$phone,$internshipagreement,$idstudent;

        public function __construct($idcurrentinternship = null,$designation = null,$description = null,$website = null,$enterprise = null,$phone = null,$internshipagreement = null,$idstudent = null){
           $this->setIdcurrentinternship($idcurrentinternship)->setDesignation($designation)->setDescription($description)->setWebsite($website)->setEnterprise($enterprise)->setPhone($phone)->setInternshipagreement($internshipagreement)->setIdstudent($idstudent);
        }

        
        public function setIdcurrentinternship($idcurrentinternship){
            $this->idcurrentinternship = $idcurrentinternship;
            return $this;
        }
        public function getIdcurrentinternship(){
            return $this->idcurrentinternship;
        }

        public function setDesignation($designation){
            $this->designation = $designation;
            return $this;
        }
        public function getDesignation(){
            return $this->designation;
        }

        public function setDescription($description){
            $this->description = $description;
            return $this;
        }
        public function getDescription(){
            return $this->description;
        }

        public function setWebsite($website){
            $this->website = $website;
            return $this;
        }
        public function getWebsite(){
            return $this->website;
        }

        public function setEnterprise($enterprise){
            $this->enterprise = $enterprise;
            return $this;
        }
        public function getEnterprise(){
            return $this->enterprise;
        }

        public function setPhone($phone){
            $this->phone = $phone;
            return $this;
        }
        public function getPhone(){
            return $this->phone;
        }

        public function setInternshipagreement($internshipagreement){
            $this->internshipagreement = $internshipagreement;
            return $this;
        }
        public function getInternshipagreement(){
            return $this->internshipagreement;
        }

        public function setIdstudent($idstudent){
            $this->idstudent = $idstudent;
            return $this;
        }
        public function getidstudent(){
            return $this->idstudent;
        }

        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $idcurrentinternship = \Controller\ControllerController::keyExist('idcurrentinternship', $d);
                    $designation = \Controller\ControllerController::keyExist('designation', $d);
                    $description = \Controller\ControllerController::keyExist('description', $d);
                    $website = \Controller\ControllerController::keyExist('website', $d);
                    $enterprise = \Controller\ControllerController::keyExist('enterprise', $d);
                    $phone = \Controller\ControllerController::keyExist('phone', $d);
                    $internshipagreement = \Controller\ControllerController::keyExist('internshipagreement', $d);
                    $idstudent = \Controller\ControllerController::keyExist('idstudent', $d);
                    $currentinternship = new self($idcurrentinternship,$designation,$description,$website,$enterprise,$phone,$internshipagreement,$idstudent);

                    array_push($objs, $currentinternship);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }