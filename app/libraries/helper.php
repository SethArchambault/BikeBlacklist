<?php

namespace Helper;

class Helper
{
    public static function SaveBikePhoto($photo_file_input, $file_dir)
    {
        // photo
        $filename['source'] = $photo_file_input->getClientOriginalName();
        $filename['basic'] = date("Y-m-d_H-i_") . $filename['source'];

        $path['source'] = $photo_file_input->getRealPath();
        $path['original'] = 'original/' . $filename['basic'];
        $path['large'] = 'large/' . $filename['basic'];
        $path['thumb'] = 'thumb/' . $filename['basic'];
        $path['public_upload_dir'] = public_path($file_dir);

        $image_obj = \Intervention\Image\Facades\Image::make($path['source']);

        $image_obj->backup();

        // save original
        $image_obj->save($path['public_upload_dir'] . $path['original']);

        // save large
        $image_obj->reset();
        $image_obj->fit(800,800);
        $image_obj->save($path['public_upload_dir'] . $path['large']);

        // create a image size
        $image_obj->reset();
        $image_obj->fit(370,247);
        $image_obj->save($path['public_upload_dir'] . $path['thumb']);

        return $filename['basic'];
    }
}