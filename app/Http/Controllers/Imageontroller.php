<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;
use File;


class Imageontroller extends Controller
{
    public function upload (Request $request){
       if($request->hasFile('image')):
        $folder = date('d-m-y h:i:s');
        foreach($request->file('image') as $image):
            $ext = 'webp';
            $convertImage = \Image::make($image->getRealPath())->encode($ext,60);
            \Storage::put('upload/'. $folder.'/'.uniqid().'.'.$ext, $convertImage);

        endforeach;
        $zip = new ZipArchive;
        $fileName = storage_path().'/app/upload/'.$folder.'.'.'zip';
        if($zip->open($fileName, ZipArchive::CREATE) === TRUE):
            $files = File::files(storage_path().'/app/upload/'.$folder);
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        else:
            echo "Folder Does Not exists";
        endif;
        return response()->download($fileName);
    endif;
    return redirect()->back()->with('success','File Upload Success full');
    }
}
