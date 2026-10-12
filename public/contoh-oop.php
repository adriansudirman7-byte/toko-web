<?php

class Mahasiswa
{
    // PROPERTY = sifat / data yang dimiliki
    public $nama;
    public $nim;

    // CONSTRUCTOR = dijalankan otomatis saat objek dibuat
    public function __construct($nama, $nim)
    {
        $this->nama = $nama;
        $this->nim = $nim;
    }

    // METHOD = kemampuan / aksi
    public function perkenalan()
    {
        return "Halo, saya " . $this->nama . " (" . $this->nim . ")";
    }
}

// Membuat OBJECT dari CLASS
$mhs1 = new Mahasiswa("Yulia", "23TRI001");
$mhs2 = new Mahasiswa("Beny", "23TRI002");

echo $mhs1->perkenalan();
echo $mhs2->perkenalan();
