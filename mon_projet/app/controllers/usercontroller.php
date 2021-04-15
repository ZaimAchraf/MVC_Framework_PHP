<?php
namespace PHPMVC\Controllers;
use PHPMVC\Lib\Helper;
use PHPMVC\Lib\InputsFilter;
use PHPMVC\Models\UserModel;
/**
/**
 *
 */
class UserController extends AbstractController
{
    use InputsFilter;
    use Helper;
	public function signinAction()
    {
        global $errors;
        if (isset($_POST['sign_in'])){

            $required_inputs['fullname']         = $fullname         = $this->filterStr($_POST['fullname']);
            $required_inputs['username']         = $username         = $this->filterStr($_POST['username']);
            $required_inputs['email']            = $email            = $this->filterEmail($_POST['email']);
            $required_inputs['password']         = $password         = $_POST['password1'];
            $required_inputs['confirm_password'] = $confirm_password = $_POST['password2'];
            $required_inputs['sex']              = $sex              = isset($_POST['sex']) ? intval($_POST['sex']) : '' ;
            $required_inputs['birthDay']         = $birthDay         = date('Y-m-d', strtotime($_POST['birthDay']));

            $city   = $this->filterStr($_POST['city']);
            $phone  = $_POST['phone']  == '' ? -1 : $this->filterInt($_POST['phone']);
            $postal = $_POST['postal'] == '' ? -1 : $this->filterInt($_POST['postal']);
            $adress = $this->filterStr($_POST['adress']);

            $errors = $this->checkRequiredInputs($required_inputs);

            if($required_inputs['confirm_password'] !== $required_inputs['password'] && empty($errors))
                $errors['verify'] = 'passwords you enter should be identical';

            $data['email'] = $email;
            $data['username'] = $username;

            if (UserModel::getByColumns($data))
                $errors['exist'] = 'email or username already exists';

            if (empty($errors)){

                $password = $this->hash_undecrypted_data($password);
                $id = uniqid($username . substr($email, 5, 10));
                $user = new userModel($id, $fullname, $username, $email, $password, $sex, $birthDay, $city, $phone, $postal, $adress);

                $user->register();

                if ($adress !== ''){
                    $user->add_adress($adress);
                }

                $this->redirect('/user/login');
            }
        }
	    $this->view();
    }

    public function loginAction()
    {
        global $errors;
        if (isset($_POST['login'])){

            $requireInputs['email'] = $email = $this->filterEmail($_POST['email']);
            $requireInputs['password'] = $password =  $this->filterStr($_POST['password']);

            $errors = $this->checkRequiredInputs($requireInputs);

            if (empty($errors)){
                $data['email'] = $email;
                if ($result = userModel::getByColumns($data)[0]){

                    if ($this->verify_hashed_undecrypted_data($password, $result->get_password())){

                        $_SESSION['userID'] = $result->get_userID();
                        $_SESSION['groupID'] = $result->get_groupID();
                        $_SESSION['userName'] = $result->get_userName();

                        $this->redirect('/');
                    }
                }
                $errors['not_exist'] = 'please check your email and password and try again';
            }
        }
        $this->view();
    }

    public function logoutAction(){
	    if (isset($_SESSION['userName'])){

	        unset($_SESSION['userID']);
	        unset($_SESSION['userName']);
	        unset($_SESSION['groupID']);
	        
	        $this->redirect('/');
        }
    }
}

