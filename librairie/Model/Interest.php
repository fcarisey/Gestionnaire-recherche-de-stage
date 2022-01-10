<?php
    namespace Model;
    Class Interest{
        private $IdUser,$IdInternship;

        public function __construct($IdUser = null,$IdInternship = null){
           $this->setIdUser($IdUser)->setIdInternship($IdInternship);
        }

        
        public function setIdUser($IdUser){
            $this->IdUser = $IdUser;
            return $this;
        }
        public function getIdUser(){
            return $this->IdUser;
        }

        public function setIdInternship($IdInternship){
            $this->IdInternship = $IdInternship;
            return $this;
        }
        public function getIdInternship(){
            return $this->IdInternship;
        }

        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $IdUser = \Controller\ControllerController::keyExist('IdUser', $d);
                    $IdInternship = \Controller\ControllerController::keyExist('IdInternship', $d);
                    $interest = new self($IdUser,$IdInternship);

                    array_push($objs, $interest);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }