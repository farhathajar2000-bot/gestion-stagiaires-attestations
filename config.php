<?php
    session_start();
    class Database {

        private static $conn = null;

        public static function getConnection() {
        if (self::$conn === null) {
            try {
                    self::$conn = new PDO("mysql:host=localhost;dbname=ista_attestations;charset=utf8", "root", "", 
                    [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    ]);
                } catch (PDOException $e) {
                    die("Connection error: " . $e->getMessage());
                }
                return self::$conn;
            }
    }
}