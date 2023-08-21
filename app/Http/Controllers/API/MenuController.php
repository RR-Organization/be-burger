<?php

namespace App\Http\Controllers\API;

use App\ApiResponse\MenuResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuResponse;

    public function __construct(MenuResponse $menuResponse)
    {
        $this->menuResponse = $menuResponse;
    }

    public function getAllData()
    {
        return $this->menuResponse->get();
    }

    public function createData(Request $request)
    {
        return $this->menuResponse->create($request);
    }
}
