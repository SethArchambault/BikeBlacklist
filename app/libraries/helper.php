<?php

namespace Helper;

use Image;
use Whoops\Example\Exception;

class Helper
{
    public static function SaveBikePhoto($photo_file_input, $file_dir)
    {
        // evaluate photo_file_input throw errors
        // photo
        $filename['source'] = $photo_file_input->getClientOriginalName();
        $filename['basic'] = date("Y-m-d_H-i_") . $filename['source'];
        $path['source'] = $photo_file_input->getRealPath();
        $path['original'] = 'original/' . $filename['basic'];
        $path['large'] = 'large/' . $filename['basic'];
        $path['thumb'] = 'thumb/' . $filename['basic'];
        $path['public_upload_dir'] = public_path($file_dir);

        $image_obj = Image::make($path['source']);

        $image_obj->backup();

        // save original
        $image_obj->save($path['public_upload_dir'] . $path['original']);

        // save large
        $image_obj->reset();
        $image_obj->fit(800,535);
        $image_obj->save($path['public_upload_dir'] . $path['large']);

        // create a image size
        $image_obj->reset();
        $image_obj->fit(370,247);
        $image_obj->save($path['public_upload_dir'] . $path['thumb']);

        return $filename['basic'];
    }

    public static function GeoJson($original_data) 
    {
        $features = array();
        foreach($original_data as $key => $value) { 
            $features[] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point', 
                    'coordinates' => [
                        (float)$value['lost_longitude'],
                        (float)$value['lost_latitude']
                    ]
                ],
                'properties' => [
                    'id' => $value['id'],
                    'bike_uid' => $value['bike_uid'],
                    'description' => $value['description'],
                    'photo' => $value['photo'],
                    'lost_date' => $value['lost_date'],
                    'theft_desc' => $value['theft_desc'],
                    'advice' => $value['advice'],
                    'created_at' => $value['created_at']
                ],
            ];
        };   

        $allfeatures = array('type' => 'FeatureCollection', 'features' => $features);
        return $allfeatures;

    }
}