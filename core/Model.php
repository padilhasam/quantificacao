<?php

    require_once dirname(__DIR__) . '/core/Database.php';

    class Model {
        protected $db;

        public function __construct() {
            $database = new Database();
            $this->db = $database->getConnection();
        }
    }