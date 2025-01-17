<?php

namespace Admin;

class AdminKurzy
{
    private $host = "localhost";
    private $dbname = "sj-2024";
    private $username = "root";
    private $password = "";
    private $port = 3307;

    private $connection;

    public function __construct()
    {
        try {
            // Vytvorenie PDO objektu a pripojenie k databáze
            $this->connection = new \PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port;charset=utf8",
                $this->username,
                $this->password
            );
            // Nastavenie PDO pre zobrazenie chýb a vynucenie vyvolávania výnimiek
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // Spracovanie chyby pripojenia
            echo "Chyba pri pripojení k databáze: " . $e->getMessage();
        }
    }

    // Výpis zoznamu prihlásených na kurzy
    public function getZoznamPrihlasenych(): array
    {
        $sql = "SELECT * FROM prihlasky";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Pridanie nového prihláseného
    public function insertPrihlaseny(array $data): bool
    {
        $insertSQL = "INSERT INTO prihlasky (nazov_kurzu, datum_kurzu, meno, priezvisko, pohlavie, vek, mesto_bydliska, stav_absolvovania) 
                      VALUES (:nazov_kurzu, :datum_kurzu, :meno, :priezvisko, :pohlavie, :vek, :mesto_bydliska, :stav_absolvovania)";
        $stmt = $this->connection->prepare($insertSQL);
        return $stmt->execute([
            ':nazov_kurzu' => $data['nazov_kurzu'],
            ':datum_kurzu' => $data['datum_kurzu'],
            ':meno' => $data['meno'],
            ':priezvisko' => $data['priezvisko'],
            ':pohlavie' => $data['pohlavie'],
            ':vek' => $data['vek'],
            ':mesto_bydliska' => $data['mesto_bydliska'],
            ':stav_absolvovania' => $data['stav_absolvovania'],
        ]);
    }

    // Úprava údajov prihláseného
    public function updatePrihlaseny(int $id, array $data): bool
    {
        $updateSQL = "UPDATE prihlasky 
                      SET nazov_kurzu = :nazov_kurzu, 
                          datum_kurzu = :datum_kurzu, 
                          meno = :meno, 
                          priezvisko = :priezvisko, 
                          pohlavie = :pohlavie, 
                          vek = :vek, 
                          mesto_bydliska = :mesto_bydliska, 
                          stav_absolvovania = :stav_absolvovania 
                      WHERE id = :id";
        $stmt = $this->connection->prepare($updateSQL);
        return $stmt->execute([
            ':nazov_kurzu' => $data['nazov_kurzu'],
            ':datum_kurzu' => $data['datum_kurzu'],
            ':meno' => $data['meno'],
            ':priezvisko' => $data['priezvisko'],
            ':pohlavie' => $data['pohlavie'],
            ':vek' => $data['vek'],
            ':mesto_bydliska' => $data['mesto_bydliska'],
            ':stav_absolvovania' => $data['stav_absolvovania'],
            ':id' => $id,
        ]);
    }

    // Odstránenie prihláseného
    public function deletePrihlaseny(int $id): bool
    {
        $deleteSQL = "DELETE FROM prihlasky WHERE id = :id";
        $stmt = $this->connection->prepare($deleteSQL);
        return $stmt->execute([':id' => $id]);
    }
}
?>
