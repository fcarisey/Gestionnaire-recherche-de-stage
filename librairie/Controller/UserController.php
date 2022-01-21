<?php
    namespace Controller;

use Model\Classe;

Class UserController extends ControllerController{
        protected static $table_name = "User";
        protected static $model_class = \Model\User::class;
        protected static $database = "grds";

        public static function login(string $username, string $password){
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            $err = [];

            $usernameParse = false;
            if (!empty($username)){
                $usernameParse = true;
            }else
                $err["username"] = "Le nom d'utilisateur est obligatoire !";

            $passwordParse = false;
            if (!empty($password)){
                if (strlen($password) >= 8){
                    $passwordParse = true;
                }else
                    $err['password'] = "Le mot de passe doît faire au moins 8 charactères !";
            }else
                $err['password'] = "Le mot de passe est obligatoire !";

            if ($usernameParse && $passwordParse){
                $user = \Controller\UserController::SELECT(\Database::SELECT_ALL, ['Username' => $username])[0];

                if (password_verify($password, $user->getPassword())){
                    $_SESSION['Id'] = $user->getIdUser();
                    $_SESSION['Username'] = $user->getUsername();
                    $_SESSION['Role'] = \Controller\RoleController::SELECT(\Database::SELECT_ALL, ['IdRole' => $user->getIdRole()]);
                    $_SESSION['LM'] = $user->getLM();
                    $_SESSION['CV'] = $user->getCV();
                    $_SESSION['ProfilPicture'] = $user->getProfilPicture();
                    $_SESSION['Email'] = $user->getEmail();
                    if ($user->getIdClasse())
                        $_SESSION['Class'] = \Controller\ClasseController::SELECT(\Database::SELECT_ALL, ['IdClasse' => $user->getIdClasse()]);
                    else
                        $_SESSION['Class'] = new Classe();

                    $err['valide'];
                }
            }

            return $err;
        }
    }