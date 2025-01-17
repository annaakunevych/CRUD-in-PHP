<?php

namespace Admin;

use Classes\Student;
use PDO;
use PDOException;

class AdminKurzov
{
    private $host = "localhost";
    private $dbname = "crud_php";
    private $username = "root";
    private $password = "";
    private $port = 3306;
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new \PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port;charset=utf8",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Chyba pri pripojení k databáze: " . $e->getMessage());
        }
    }


	// Získavame všetkých študentov
    public function getAllStudents(): array
    {
        $sql = "SELECT * FROM studenti";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

	    // Získame jedného študenta podľa ID
    public function getStudentById(int $id): ?array
    {
        $stmt = $this->connection->prepare("SELECT * FROM studenti WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        return $student ?: null;
    }

	// Pridame jedneho študenta podla ID
    public function addStudent(Student $student): bool
    {
        $sql = "INSERT INTO studenti (id, nazov_kurzu, datum_kurzu, meno, priezvisko, pohlavie, vek, mesto_bydliska, stav_absolvovania)
                VALUES (null, :nazov_kurzu, :datum_kurzu, :meno, :priezvisko, :pohlavie, :vek, :mesto_bydliska, :stav_absolvovania)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            ':nazov_kurzu' => $student->nazov_kurzu,
            ':datum_kurzu' => $student->datum_kurzu,
            ':meno' => $student->meno,
            ':priezvisko' => $student->priezvisko,
            ':pohlavie' => $student->pohlavie,
            ':vek' => $student->vek,
            ':mesto_bydliska' => $student->mesto_bydliska,
            ':stav_absolvovania' => $student->stav_absolvovania
        ]);
    }


	// Aktualizujem študenta	
    public function updateStudent(Student $student): bool
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
            ':nazov_kurzu' => $student->nazov_kurzu,
            ':datum_kurzu' => $student->datum_kurzu,
            ':meno' => $student->meno,
            ':priezvisko' => $student->priezvisko,
            ':pohlavie' => $student->pohlavie,
            ':vek' => $student->vek,
            ':mesto_bydliska' => $student->mesto_bydliska,
            ':stav_absolvovania' => $student->stav_absolvovania,
            ':id' => $student->id
        ]);
    }

	// Vymaz študenta
    public function deleteStudent(int $id): bool
    {
        $sql = "DELETE FROM studenti WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
