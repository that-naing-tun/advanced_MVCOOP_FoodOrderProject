<?php
session_start();
class Users extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('AddressModel');
        $this->model('UserModel');
        $this->db = new Database();
    }

    public function formRegister()

    {

        if (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['email_check']) &&
            $_POST['email_check'] == 1
        ) {
            $email = $_POST['email'];
            // call columnFilter Method from Database.php
            $isUserExist = $this->db->columnFilter('users', 'email', $email);
            if ($isUserExist) {
                echo 'Sorry! email has already taken. Please try another.';
            }
        }
    }

    public function register()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check user exist
            $email = $_POST['email'];
            // call columnFilter Method from Database.php
            $isUserExist = $this->db->columnFilter('users', 'email', $email);
            if ($isUserExist) {
                //setMessage('error', 'This email is already registered !');
                redirect('pages/register');
            } else {
                // Validate entries
                $validation = new UserValidator($_POST);
                $data = $validation->validateForm();
                if (count($data) > 0) {
                    $this->view('pages/register', $data);
                } else {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone_number = $_POST['phonenumber'];
                    $password = $_POST['password'];
                    $addressId = 0;

                    //Hash Password before saving
                    $password = base64_encode($password);

                    $user = new UserModel();
                    $user->setPhoneNumber($phone_number);
                    $user->setName($name);
                    $user->setEmail($email);
                    $user->setPassword($password);
                    // $user->setToken($token);

                    $userCreated = $this->db->create('users', $user->toArray());
                    //$userCreated="true";

                    redirect('pages/login');
                } // end of validation check
            } // end of user-exist
        }
    }



    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = base64_encode($_POST['password']);

                $isLogin = $this->db->loginCheck($email, $password);
                // print_r($isLogin);
                // die();
                if ($isLogin) {
                    $_SESSION['email'] = $email;
                    redirect('pages/index');
                }



                // print_r($isLogin);
                // exit;

                // if ($isLogin) {
                //     setMessage('id', base64_encode($isLogin['id']));
                //     $id = $isLogin['id'];
                //     $setLogin = $this->db->setLogin($id);
                //     redirect('pages/dashboard');
                // } else {
                //     setMessage('error', 'Login Fail!');
                //     redirect('pages/login');
                // }


                // if ($isLogin == null) {
                //     setMessage('error', 'Login Failed Please Try Again');
                //     redirect('pages/login');
                // }

                if ($isLogin['role'] == 1) {
                    redirect('dashboard/index');
                } else {
                    setMessage('success', 'Login Successful');
                    redirect('pages/index');
                }




                // setMessage('success', 'Login Successful');
                // redirect('pages/index');

                // $isEmailExist = $this->db->columnFilter('users', 'email', $email);
                // print_r($isEmailExist);
                // exit;
                // $isPasswordExist = $this->db->columnFilter('users', 'password', $password);

                // if ($isEmailExist && $isPasswordExist) {
                //     echo "Login success";
                // } else {
                //     echo "login fail";
                // }
                // print_r($email);
                // print_r($password);
            }
        }
    }

    function logout($id)
    {
        // session_start();
        // $this->db->unsetLogin(base64_decode($_SESSION['id']));

        //$this->db->unsetLogin($this->auth->getAuthId());
        $this->db->unsetLogin($id);
        redirect('pages/login');
    }

    public function destroy($id)
    {
        $id = base64_decode($id);

        $user = new UserModel();

        $user->setId($id);

        $isDestroyed = $this->db->delete('users', $user->getId());
        // $id = $_POST['id'];
        //$this->db->delete('expenses', $id);
        //setMessage("Expense Data has been Deleted");
        redirect('dashboard/admin');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['user_id'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone_number = $_POST['phoneNumber'];
            $street_id = $_POST['street_name'];



            $address  = new AddressModel();
            $address->setId("");
            $address->setUserId($id);
            $address->setStreet_id($street_id);

            $addressExist = $this->db->getAddressId('address', $street_id);
            // print_r($addressExist);
            // exit;
            // print_r($addressExist);
            // exit;
            if ($addressExist) {
                $addressId = $addressExist['id'];
                // print_r($addressId);
                // exit;
            } else {
                $addressCreate = $this->db->create('address', $address->toArray());
                $addressId = (int)$addressCreate;
            }
            $user = new UserModel();
            $user->setId($id);
            $user->setName($name);
            $user->setEmail($email);
            $user->setPhoneNumber($phone_number);
            $user->setPassword($password);

            $iscreated = $this->db->update('users', $user->getId(), $user->toArray());
            redirect('pages/profile');
        }
    }
}
