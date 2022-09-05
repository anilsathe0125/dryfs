<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;



class ImageHelper
{

    public static function handleUploadedImage($file, $path, $delete = null){
        if ($file) {
            // Delete Image Which Exists In Directory
            if ($delete){
                if (file_exists($delete)) {
                    unlink($delete);
                }
            }
            $name = microtime() . '-' . $file->getClientOriginalName();
            $file->move(public_path($path), $name);
            return $path . "/" . $name;
        }
    }

    public static function itemHandleUploadedimage($file, $path, $delete = null){
        if ($file) {
            // Delete Image Which Exists In Directory
            if ($delete){
                if (file_exists($delete)) {
                    unlink($delete);
                }
            }

            if (!file_exists($path . '/' . 'thumbnails')) {
                mkdir(public_path($path . '/' . 'thumbnails'), 0777, true);
            }

            $thumb = microtime() . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(230, 230);
            $thumb_save_path = public_path($path) . "/thumbnails" . "/" . $thumb;
            $image->save($thumb_save_path);

            $photo = microtime() . '-' . $file->getClientOriginalName();
            $file->move(public_path($path), $photo);

            return [
                $path. '/' . $photo,
                $path . '/thumbnails' . '/' . $thumb
            ];
        }
    }

    public static function handleUpdatedUploadedImage($file, $path, $data, $field){
        $name = microtime() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path($path), $name);

        if ($data[$field] != null) {
            if (file_exists($data[$field])) {
                unlink($data[$field]);
            }
        }

        return $path . '/' . $name;
    }

    public static function itemHandleUpdatedUploadedImage($file, $path, $data, $field)
    {
        $thumb = microtime() . '.' . $file->getClientOriginalExtension();
        $image = Image::make($file)->resize(230, 230);
        $thumb_save_path = public_path($path) . "/thumbnails" . "/" . $thumb;
        $image->save($thumb_save_path);

        $photo = microtime() . '-' . $file->getClientOriginalName();
        $file->move(public_path($path), $photo);

        if($data['thumbnail']){
            if(file_exists($data['thumbnail'])){
                unlink($data['thumbnail']);
            }
        }

        if($data[$field] != null){
            if(file_exists($data[$field])){
                unlink($data[$field]);
            }
        }

        return [
            $path. '/' . $photo,
            $path . '/thumbnails' . '/' . $thumb
        ];
    }

    public static function handleDeletedImage($data, $field)
    {
        if($data[$field] != null){
            if(file_exists($data[$field])){
                unlink($data[$field]);
            }
        }
    }

}
