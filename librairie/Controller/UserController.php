<?php
    namespace Controller;

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
                $err["username"] = "Le nom d'utilisateur est obligatoire.";

            $passwordParse = false;
            if (!empty($password)){
                if (strlen($password) >= 8){
                    $passwordParse = true;
                }else
                    $err['password'] = "Le mot de passe fait au moins 8 charactères.";
            }else
                $err['password'] = "Le mot de passe est obligatoire.";

            if ($usernameParse && $passwordParse){
                $user = \Controller\UserController::SELECT(\Database::SELECT_ALL, ['Username' => $username]);

                if (!$user)
                    $err['account'] = "Ce compte utilisateur n'existe pas !";
                else{
                    $user = $user[0];
                    if (password_verify($password, $user->getPassword())){
                        $_SESSION['Id'] = $user->getIdUser();
                        $_SESSION['Username'] = $user->getUsername();
                        $_SESSION['Role'] = serialize(\Controller\RoleController::SELECT(\Database::SELECT_ALL, ['IdRole' => $user->getIdRole()])[0]);
                        $_SESSION['LM'] = $user->getLM();
                        $_SESSION['CV'] = $user->getCV();
                        $_SESSION['ProfilPicture'] = $user->getProfilPicture();
                        $_SESSION['Courriel'] = $user->getEmail();
                        if ($user->getIdClasse())
                            $_SESSION['Class'] = serialize(\Controller\ClasseController::SELECT(\Database::SELECT_ALL, ['IdClasse' => $user->getIdClasse()])[0]);
                        else
                            $_SESSION['Class'] = serialize(new \Model\Classe());
    
                        $err['valide'] = true;
                    }else
                        $err['account'] = "Ce compte utilisateur n'existe pas !";
                }
            }

            return $err;
    }
}