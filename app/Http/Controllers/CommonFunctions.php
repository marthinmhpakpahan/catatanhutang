<?php

namespace App\Http\Controllers;

class CommonFunctions
{
    public static function uploadFiles($file, $type) {
        $FOLDER_DESTINATION = [
            'USER_PHOTO' => "assets/img/users/photos/",
            'DEBTER_PHOTO' => "assets/img/debter/photos/",
        ];

        $file_extension = $file->getClientOriginalExtension();
        $folder_destination = $FOLDER_DESTINATION[$type];
        $destination_filename = str()->random(10) . "" . time() . "." . $file_extension;
        $file->move($folder_destination, $destination_filename);
        $file_path = $folder_destination . $destination_filename;
        
        return $file_path;
    }
}
