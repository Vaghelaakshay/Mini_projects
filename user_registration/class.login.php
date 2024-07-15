<?php 

class loginUser{
    
    private $username;
    private $password;
    public $error;
    public $success;
    private $storage = "data.json";
    private $stored_user;

    public function __construct($username,$password){
        $this->username = $username; 
        $this->password = $password; 
        if (file_exists($this->storage)) {
            $json_data = file_get_contents($this->storage);
            $this->stored_user = json_decode($json_data, true);
            if (!is_array($this->stored_user)) {
                $this->stored_user = [];
            }
        }
        $this->login();
    }
    private function login(){
        foreach ($this->stored_user as $user) {
            if ($user['username'] == $this->username) {
                if (password_verify($this->password,$user['password'])) {
                    session_start();
                    $_SESSION['user'] = $this->username;
                    header("location:profile.php"); exit();
                }
            }
        }  
        return $this->error = "wrong username or password";  
    }


}