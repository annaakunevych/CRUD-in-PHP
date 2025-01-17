<?php

namespace Classes;

class Student
{
    public $id;
    public $nazov_kurzu;
    public $datum_kurzu;
    public $meno;
    public $priezvisko;
    public $pohlavie;
    public $vek;
    public $mesto_bydliska;
    public $stav_absolvovania;

    public function __construct($id, $nazov_kurzu, $datum_kurzu, $meno, $priezvisko, $pohlavie, $vek, $mesto_bydliska, $stav_absolvovania)
    {
       // $this->id = $id;
        $this->nazov_kurzu = $nazov_kurzu;
        $this->datum_kurzu = $datum_kurzu;
        $this->meno = $meno;
        $this->priezvisko = $priezvisko;
        $this->pohlavie = $pohlavie;
        $this->vek = $vek;
        $this->mesto_bydliska = $mesto_bydliska;
        $this->stav_absolvovania = $stav_absolvovania;
    }
}
?>

