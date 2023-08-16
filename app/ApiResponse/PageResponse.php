<?php

namespace App\ApiResponse;

use App\Repository\PageRepository;
use Illuminate\Http\Request;

class PageResponse
{
    protected $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function get()
    {
        $data = $this->pageRepository->getAllData();
        {
            if ($data === "dnf-getAllData") {
                return response()->json([
                    'code' => 404,
                    'message' => 'Data not found',
                ]);
            }else{
                return response()->json([
                    'code' => 200,
                    'message' => 'Success get all data',
                    'data' => $data
                ]);
            }
        }
    }

    public function create(Request $request)
    {
        $data = $this->pageRepository->createData($request);
        if ($data instanceof \Illuminate\Validation\Validator && $data->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Check your validation',
                'errors' => $data->errors()
            ]);
        }

        if ($data === 'check-status') {
           return response()->json([
            'code' => 400,
            'message' => 'Form telah di disable'
           ]);
        }

        if ($data instanceof \Throwable) {
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'errors' => $data->getMessage()
            ]);
        }
            return response()->json([
                'code' => 200,
                'message' => 'success create data',
                'data' => $data
            ]);
        
    }
}