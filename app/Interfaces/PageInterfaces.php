<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

Interface PageInterfaces {
    public function getAllData();
    public function createData(Request $request);
}