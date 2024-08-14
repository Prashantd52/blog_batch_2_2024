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

    public function uploadBase64Image($image,$path=null,$filename=null)
    {
        $image_64 = $image; //your base64 encoded data
        // $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        $extension = '.png';
        $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
      	  
        // find substring fro replace here eg: data:image/png;base64,
        $image = str_replace($replace, '', $image_64); 
        $image = str_replace(' ', '+', $image); 
        
        if(!$filename)
        {
            $tempName=Str::random(4);
            $filename=time().'-'.$tempName.'.'.$extension;
        }
        else{
            $filename=$filename.'.'.$extension;
        }
        if(!$path)
        {
            $path='uploads';
        }

        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }

        $success = file_put_contents($path.'/'.$filename, base64_decode($image));
        // $success=Storage::disk('public')->put($path.'/'.$imageName , base64_decode($image));
        $f1=$success? $path.'/'.$filename : null;
        return $f1;
    }
}