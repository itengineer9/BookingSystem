<?php


class Validation {
    
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect('sql308.epizy.com', 'epiz_27878131', 'dn2jTuIXpp', 'epiz_27878131_termine')
         or die ("Die Verbindung zur Datenbank war nicht erfolgreich !");
    }
    
    /**
     *  Make Validation for user-Inputs to prevent HTML or SQL injections
     * $input String username inputs
     */
    public function userNameValidation($input) {
        $input1 = $this->validateInputs($input);
        echo 'Hallooo Inputs';
        if(!preg_match("/([A-ZÖÄÜa-zäöüß0-9])*$/i",$input1)){
             return false;
        } 
        return $input1;
    }
    
    /**
     * 
     * @param type $email
     * @return boolean
     */
    public function emailValidation($email) {
        $email= $this->validateInputs($email);
            
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            
            return false;
        } 
        return $email;
    }
    
    /**
     * Make Validation for user-Inputs to prevent HTML or SQL injections
     * @param string or number $input that want to check validation for it
     * @return string or number that has valid value
     */
    public function validateInputs($input) {
        $input  = trim($input);
        $input  = stripcslashes($input);
        $input  = htmlspecialchars($input);
        $input  = strip_tags($input);
        $input  = mysqli_real_escape_string($this->conn, $input);
        
        return $input;
    }
}
