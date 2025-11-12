<?php
class database{
    private $db;
    public function __construct(){
        $this->db = new mysqli("localhost", "root", "", "claex");
    }
    
    public function getDb() : mysqli {
        return $this->db;
    }
}
