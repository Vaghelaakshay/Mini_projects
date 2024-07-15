
<?php 
class registrerUser{
    private $username;
    private $raw_password;
    private $encrypted_password;
    public $error;
    public $success;
    private $storage = "data.json";
    private $stored_user;
    private $new_user;
   
      public function __construct($username,$password){
        $this->username = trim($this->username);
        $this->username = filter_var($username,FILTER_SANITIZE_STRING);

        $this->raw_password = filter_var(trim($password),FILTER_SANITIZE_STRING);
        $this->encrypted_password = password_hash($this->raw_password,PASSWORD_DEFAULT);
        
         if (file_exists($this->storage)) {
            $json_data = file_get_contents($this->storage);
            $this->stored_user = json_decode($json_data, true);
            if (!is_array($this->stored_user)) {
                $this->stored_user = [];
            }
        }

        $this->new_user =[
            "username" => $this->username,
            "password" => $this->encrypted_password,
        ];
        if ($this->checkFieldValues()) {
            $this->insertUser();
        }
    }
    private function checkFieldValues(){
        if (empty($this->username)||empty($this->raw_password)) {  
            $this->error = "Both fields are required";
            return false;
        } else {
           return true;
        }
        
    }
    private function usernameExists(){
        foreach ($this->stored_user as $user) {
            if ($this->username == $user["username"]) {
               $this->error = "Username already Taken, Please choose different one";
               return true;
            }
            return false;
        }
    }
    private function insertUser(){ 
        if ($this->usernameExists() ==false) {
          array_push($this->stored_user,$this->new_user);
          if (file_put_contents($this->storage,json_encode($this->stored_user,JSON_PRETTY_PRINT))) {
          return $this->success = "your registration was successful";
          } else {
            return $this->error = "something went wrong, please try again";
          }
          
        }
    }


}