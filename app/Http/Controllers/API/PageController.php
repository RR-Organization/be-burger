<?php

namespace App\Http\Controllers\API;

use App\ApiResponse\PageResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $pageResponse;

    public function __construct(PageResponse $pageResponse)
    {
       $this->pageResponse = $pageResponse;
    }

    public function getAllData()
    {
        return $this->pageResponse->get();
    }

    public function createData(Request $request)
    {
       return $this->pageResponse->create($request);
    }
}
