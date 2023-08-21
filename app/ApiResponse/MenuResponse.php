<?php

namespace App\ApiResponse;

use App\Repository\MenuRepository;
use Illuminate\Http\Request;

class MenuResponse{

    protected  $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function get()
    {
        $data =  $this->menuRepository->getAllData();
        if ($data === 'dnf-getAllData') {
            return response()->json([
                'code' => 404,
                'message' => 'Data not found'
            ]);
        }else{
            return response()->json([
                'code' => 200,
                'message' => 'succes get all data',
                'data' => $data
            ]);
        }
    }

    public function create(Request $request)
    {
        $data = $this->menuRepository->createData($request);

        if ($data instanceof  \Illuminate\Validation\Validator && $data->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'Check your validation',
                'errors' => $data->errors()
            ]);
        }

        if ($data instanceof \Throwable) {
            return response()->json([
                'code' => 400,
                'message' => 'failed',
                'errors' => $data->getMessage()
            ]);
        }else{
            return response()->json([
                'code' => 200,
                'message' => 'Success create data',
                'data' => $data
            ]);
        }
    }
}