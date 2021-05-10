<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Image;

trait CommonTrait
{



    /*
    Method Name: createThumbnail
    Created Date: 2021-03-15 (yyyy-mm-dd)
    Purpose: To create thumbnail at fly
    Params: []
    */
    public function createThumbnail($image, $extension, $width = 250, $height = 75)
    {
        try{
            $image_resize = Image::make($image)->resize( $width, $height, function ( $constraint ) {
            $constraint->aspectRatio();
            })->encode($extension);
            return $image_resize;
        }
        catch(\Exception $e)
        {
        return FALSE;
        }
    }
    /* End Method createThumbnail */

}

