<?php

namespace App\Repository;

use App\Interfaces\PageInterfaces;
use App\Models\PageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageRepository implements PageInterfaces
{
    protected $model;

    public function __construct(PageModel $model)
    {
        $this->model = $model;
    }

    public function getAllData()
    {

        $data = $this->model->all();
        if ($data->isEmpty()) {
            return ('dnf-getAllData');
        }
        return $data;
    }

    public function createData(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'description' => 'required'
        ]);

        if ($validation->fails()) {
            return $validation;  
        }

        $status = $this->model->where('status', true)->first();
        if ($status) {
            return ('check-status');
        }

        try {
            $data = new $this->model;
            $data->description = $request->input('description');
            $data->status = true;
            $data->save();

            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
