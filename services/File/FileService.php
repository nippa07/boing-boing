<?php

namespace services\File;

use Illuminate\Support\Facades\Config;

class FileService
{
    protected $upload_path;

    public function __construct()
    {
        $this->upload_path = Config::get('files.upload_path');
    }

    public function up($file)
    {

        if ($file) {
            //Generate file name to store
            $file_name = md5(date('yyyymmddhhss') . rand()) . '.' . $file->getClientOriginalExtension();

            //Upload File
            $file->move(public_path($this->upload_path) . '/', $file_name);

            return ['status' => 1, 'data' => $file_name];
        }
        return ['status' => 0, 'data' => ''];
    }
}
