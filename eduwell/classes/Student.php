<?php

namespace classes;

use PDO;
use PDOException;

class Student
{
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                "mysql:host=localhost;dbname=sj-2024;port=3307;charset=utf8",
                "root",
                ""
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Chyba pripojenia k databáze: " . $e->getMessage());
        }
    }

    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS studenti ( 
            id INT AUTO_INCREMENT PRIMARY KEY,
            nazov_kurzu VARCHAR(45) NOT NULL,
            datum_kurzu DATE NOT NULL,
            meno VARCHAR(45) NOT NULL,
            priezvisko VARCHAR(45) NOT NULL,
            pohlavie ENUM('Muž', 'Žena') NOT NULL,
            vek INT NOT NULL,
            mesto_bydliska VARCHAR(45) NOT NULL,
            stav_absolvovania ENUM('Očakáva', 'Študuje', 'Absolvoval') NOT NULL
        );";

        try {
            $this->connection->exec($sql);
            echo "Tabuľka 'studenti' bola vytvorená.";
        } catch (PDOException $e) {
            echo "Chyba pri vytváraní tabuľky: " . $e->getMessage();
        }
    }

    public function insertStudent($nazov_kurzu, $datum_kurzu, $meno, $priezvisko, $pohlavie, $vek, $mesto_bydliska, $stav_absolvovania)
    {
        $sql = "INSERT INTO studenti (nazov_kurzu, datum_kurzu, meno, priezvisko, pohlavie, vek, mesto_bydliska, stav_absolvovania) 
                VALUES (:nazov_kurzu, :datum_kurzu, :meno, :priezvisko, :pohlavie, :vek, :mesto_bydliska, :stav_absolvovania)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            ':nazov_kurzu' => $nazov_kurzu,
            ':datum_kurzu' => $datum_kurzu,
            ':meno' => $meno,
            ':priezvisko' => $priezvisko,
            ':pohlavie' => $pohlavie,
            ':vek' => $vek,
            ':mesto_bydliska' => $mesto_bydliska,
            ':stav_absolvovania' => $stav_absolvovania
        ]);
    }

    public function getAllStudents()
    {
        $sql = "SELECT * FROM studenti";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteStudent($id)
    {
        $sql = "DELETE FROM studenti WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function updateStudent($id, $nazov_kurzu, $datum_kurzu, $meno, $priezvisko, $pohlavie, $vek, $mesto_bydliska, $stav_absolvovania)
    {
        $sql = "UPDATE studenti SET 
                nazov_kurzu = :nazov_kurzu, 
                datum_kurzu = :datum_kurzu, 
                meno = :meno, 
                priezvisko = :priezvisko, 
                pohlavie = :pohlavie, 
                vek = :vek, 
                mesto_bydliska = :mesto_bydliska, 
                stav_absolvovania = :stav_absolvovania 
                WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nazov_kurzu' => $nazov_kurzu,
            ':datum_kurzu' => $datum_kurzu,
            ':meno' => $meno,
            ':priezvisko' => $priezvisko,
            ':pohlavie' => $pohlavie,
            ':vek' => $vek,
            ':mesto_bydliska' => $mesto_bydliska,
            ':stav_absolvovania' => $stav_absolvovania
        ]);
    }
}
