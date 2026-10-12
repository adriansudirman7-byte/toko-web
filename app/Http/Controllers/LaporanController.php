<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function menipis()
    {
        return 'Laporan stok menipis - /admin/laporan/stok-menipis';
    }

    public function habis()
    {
        return 'Laporan stok habis - /admin/laporan/stok-habis';
    }
}