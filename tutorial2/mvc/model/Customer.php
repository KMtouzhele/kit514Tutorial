<?php

class Customer {  
    public $id;  
    public $fname;  
    public $lname;  
    public $email;  
      
    public function __construct($id, $fname, $lname, $email)    
    {    
        $this->id = $id;  
        $this->fname = $fname;  
        $this->lname = $lname;  
        $this->email = $email;  
    }   
}  

?>