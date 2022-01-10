<?php
    namespace Model;
    Class User{
        private $IdUser,$Username,$Password,$LM,$CV,$ProfilPicture,$Email,$IdRole,$IdClasse;

        public function __construct($IdUser = null,$Username = null,$Password = null,$LM = null,$CV = null,$ProfilPicture = null,$Email = null,$IdRole = null,$IdClasse = null){
           $this->setIdUser($IdUser)->setUsername($Username)->setPassword($Password)->setLM($LM)->setCV($CV)->setProfilPicture($ProfilPicture)->setEmail($Email)->setIdRole($IdRole)->setIdClasse($IdClasse);
        }

        
        public function setIdUser($IdUser){
            $this->IdUser = $IdUser;
            return $this;
        }
        public function getIdUser(){
            return $this->IdUser;
        }

        public function setUsername($Username){
            $this->Username = $Username;
            return $this;
        }
        public function getUsername(){
            return $this->Username;
        }

        public function setPassword($Password){
            $this->Password = $Password;
            return $this;
        }
        public function getPassword(){
            return $this->Password;
        }

        public function setLM($LM){
            $this->LM = $LM;
            return $this;
        }
        public function getLM(){
            return $this->LM;
        }

        public function setCV($CV){
            $this->CV = $CV;
            return $this;
        }
        public function getCV(){
            return $this->CV;
        }

        public function setProfilPicture($ProfilPicture){
            $this->ProfilPicture = $ProfilPicture;
            return $this;
        }
        public function getProfilPicture(){
            return $this->ProfilPicture;
        }

        public function setEmail($Email){
            $this->Email = $Email;
            return $this;
        }
        public function getEmail(){
            return $this->Email;
        }

        public function setIdRole($IdRole){
            $this->IdRole = $IdRole;
            return $this;
        }
        public function getIdRole(){
            return $this->IdRole;
        }

        public function setIdClasse($IdClasse){
            $this->IdClasse = $IdClasse;
            return $this;
        }
        public function getIdClasse(){
            return $this->IdClasse;
        }

        
        public static function format($data){

            $objs = [];

            if ($data != NULL){

                foreach($data as $d){

                    $IdUser = \Controller\ControllerController::keyExist('IdUser', $d);
                    $Username = \Controller\ControllerController::keyExist('Username', $d);
                    $Password = \Controller\ControllerController::keyExist('Password', $d);
                    $LM = \Controller\ControllerController::keyExist('LM', $d);
                    $CV = \Controller\ControllerController::keyExist('CV', $d);
                    $ProfilPicture = \Controller\ControllerController::keyExist('ProfilPicture', $d);
                    $Email = \Controller\ControllerController::keyExist('Email', $d);
                    $IdRole = \Controller\ControllerController::keyExist('IdRole', $d);
                    $IdClasse = \Controller\ControllerController::keyExist('IdClasse', $d);
                    $user = new self($IdUser,$Username,$Password,$LM,$CV,$ProfilPicture,$Email,$IdRole,$IdClasse);

                    array_push($objs, $user);
                }
            }
            return (empty($objs)) ? null : $objs;
        }
    }