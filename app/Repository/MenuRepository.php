<?php

namespace App\Repository;

use App\Interfaces\MenuInterfaces;
use App\Models\MenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MenuRepository implements MenuInterfaces {
    
    protected $model;

    public function __construct(MenuModel $model)
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
        $validation = Validator::make($request->all(), [
            'nama_menu' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'required|image'
        ]);

        if ($validation->fails()) {
            return $validation;
        }

        try {
            $data = new $this->model;
            $data->nama_menu = $request->input('nama_menu');
            $data->harga = $request->input('harga');
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $extention = $file->getClientOriginalExtension();
                $filename = 'MENU-' . Str::random(12) . '.' .  $extention;
                Storage::makeDirectory('uploads/Menu');
                $file->move(public_path('upload/Menu'),$filename);
                $data->gambar = $filename;
            }
            $data->save();

            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }

}