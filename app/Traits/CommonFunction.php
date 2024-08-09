<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait CommonFunction
{
    public function uploadFile($file, $path)
    {

        $extension = $file->getClientOriginalExtension();
        $imageName = time().'.'.$extension;  
        $file->move(public_path($path), $imageName);
        
        return $path.$imageName;
    }
}