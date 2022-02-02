<?php
    namespace Model;
    Class Classe{
        private $idclasse,$designation,$internshipdatestart,$internshipdateend;

        public function __construct($idclasse = null,$designation = null,$internshipdatestart = null,$internshipdateend = null){
           $this->setIdclasse($idclasse)->setDesignation($designation)->setInternshipdatestart($internshipdatestart)->setInternshipdateend($internshipdateend);
        }

        
        public function setIdclasse($idclasse){
            $this->idclasse = $idclasse;
            return $this;
        }
        public function getIdclasse(){
            return $this->idclasse;
        }

        public function setDesignation($designation){
            $this->designation = $designation;
            return $this;
        }
        public function getDesignation(){
            return $this->designation;
        }

        public function setInternshipdatestart($internshipdatestart){
            $this->internshipdatestart = $internshipdatestart;
            return $this;
        }
        public function getInternshipdatestart(){
            return $this->internshipdatestart;
        }

        public function setInternshipdateend($internshipdateend){
            $this->internshipdateend = $internshipdateend;
            return $this;
        }
        public function getInternshipdateend(){
            return $this->internshipdateend;
        }

        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $idclasse = \Controller\ControllerController::keyExist('idclasse', $d);
                    $designation = \Controller\ControllerController::keyExist('designation', $d);
                    $internshipdatestart = \Controller\ControllerController::keyExist('internshipdatestart', $d);
                    $internshipdateend = \Controller\ControllerController::keyExist('internshipdateend', $d);
                    $classe = new self($idclasse,$designation,$internshipdatestart,$internshipdateend);

                    array_push($objs, $classe);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }