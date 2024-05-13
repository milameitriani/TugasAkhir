<?php 

namespace App\Traits;

trait FileUpload
{

    public function upload(Object $file): String
    {
        $filename = $this->getFilename($file);

        $file->storeAs('/public/menus', $filename);

        return $filename;
    }

    public function getFilename(Object $file): String
    {
        $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $time = time();

        return $time.'.'.$extension;
    }

}

 ?>