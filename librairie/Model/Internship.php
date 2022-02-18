<?php
    namespace Model;
    Class Internship{
        private $idinternship,$designation,$description,$shortdescription,$website,$enterprise,$email,$phone,$isdone,$idclasse;

        public function __construct($idinternship = null,$designation = null,$description = null,$shortdescription = null,$website = null,$enterprise = null,$email = null,$phone = null,$isdone = null,$idclasse = null){
           $this->setIdinternship($idinternship)->setDesignation($designation)->setDescription($description)->setShortdescription($shortdescription)->setWebsite($website)->setEnterprise($enterprise)->setEmail($email)->setPhone($phone)->setIsdone($isdone)->setIdclasse($idclasse);
        }

        
        public function setIdinternship($idinternship){
            $this->idinternship = $idinternship;
            return $this;
        }
        public function getIdinternship(){
            return $this->idinternship;
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

        public function setShortdescription($shortdescription){
            $this->shortdescription = $shortdescription;
            return $this;
        }
        public function getShortdescription(){
            return $this->shortdescription;
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

        public function setEmail($email){
            $this->email = $email;
            return $this;
        }
        public function getEmail(){
            return $this->email;
        }

        public function setPhone($phone){
            $this->phone = $phone;
            return $this;
        }
        public function getPhone(){
            return $this->phone;
        }

        public function setIsdone($isdone){
            $this->isdone = $isdone;
            return $this;
        }
        public function getIsdone(){
            return $this->isdone;
        }

        public function setIdclasse($idclasse){
            $this->idclasse = $idclasse;
            return $this;
        }
        public function getIdclasse(){
            return $this->idclasse;
        }

        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $idinternship = \Controller\ControllerController::keyExist('idinternship', $d);
                    $designation = \Controller\ControllerController::keyExist('designation', $d);
                    $description = \Controller\ControllerController::keyExist('description', $d);
                    $shortdescription = \Controller\ControllerController::keyExist('shortdescription', $d);
                    $website = \Controller\ControllerController::keyExist('website', $d);
                    $enterprise = \Controller\ControllerController::keyExist('enterprise', $d);
                    $email = \Controller\ControllerController::keyExist('email', $d);
                    $phone = \Controller\ControllerController::keyExist('phone', $d);
                    $isdone = \Controller\ControllerController::keyExist('isdone', $d);
                    $idclasse = \Controller\ControllerController::keyExist('idclasse', $d);
                    $internship = new self($idinternship,$designation,$description,$shortdescription,$website,$enterprise,$email,$phone,$isdone,$idclasse);

                    array_push($objs, $internship);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }