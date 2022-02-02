<?php
    namespace Model;
    Class Interest{
        private $idstudent,$idinternship;

        public function __construct($idstudent = null,$idinternship = null){
           $this->setIdstudent($idstudent)->setIdinternship($idinternship);
        }

        
        public function setIdstudent($idstudent){
            $this->idstudent = $idstudent;
            return $this;
        }
        public function getIdstudent(){
            return $this->idstudent;
        }

        public function setIdinternship($idinternship){
            $this->idinternship = $idinternship;
            return $this;
        }
        public function getIdinternship(){
            return $this->idinternship;
        }

        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $idstudent = \Controller\ControllerController::keyExist('idstudent', $d);
                    $idinternship = \Controller\ControllerController::keyExist('idinternship', $d);
                    $interest = new self($idstudent,$idinternship);

                    array_push($objs, $interest);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }