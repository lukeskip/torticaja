<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function serve_file($filename){
        // $filePath = storage_path().'/app/img/outcomes/'.$filename;

        $filePath = Storage::url('/app/img/outcomes/'.$filename);

        if ( ! File::exists($filePath)){
            return Response::make("File does not exist.", 404);
        }

        $fileContents = File::get($filePath);

        // return Response::make($fileContents, 200,array('content-type' => 'image/jpeg'));

        return response()->file($filePath);
    }
}
