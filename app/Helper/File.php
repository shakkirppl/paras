<?php
namespace App\Helper;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

Trait File
{   


    public function file( $file, $path, $width, $height ) : string
    {
try{
       if ( $file ) {

        $randomId       =   rand(1000,9000);
        $storyimagename = time().$randomId.'.'.$file->getClientOriginalExtension();

        $destinationPath = $path;
        $thumb_img = Image::make($file->getRealPath())->resize($width,$height);
        $thumb_img->save($destinationPath.'/'.$storyimagename,80);
  
      return $storyimagename;

     
       }
     }
      catch (\Exception $e) {
         return $e->getMessage();
      }

    }
   
}