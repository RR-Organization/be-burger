<?php

namespace App\ApiResponse;

use App\Repository\PageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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

    public function update(Request $request, $id)
    {
        $data = $this->pageRepository->updateData($request, $id);
        if ($data === 'id-notfound') {
            return response()->json([
                'code' => 404,
                'message' => 'Id or data not found'
            ]);
        }
     
        if ($data instanceof \Illuminate\Validation\Validator && $data->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Check your validation',
                'errors' => $data->errors()
            ]);
        }

        

        if ($data instanceof \Throwable) {
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'errors' => $data->getMessage()
            ]);
        }else{
            return response()->json([
                'code' => 200,
                'message' => 'success update data',
                'data' => $data
            ]);
        }
    }
}