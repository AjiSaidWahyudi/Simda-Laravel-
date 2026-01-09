<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    public static function compressImage($file, $path)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)->orient();

        // ✅ JAGA RASIO (ANTI GEPENG)
        $image->scaleDown(width: 1280);

        $quality = 80;
        $filename = time() . '-' . uniqid() . '.jpg';

        do {
            $image->save($path.'/'.$filename, quality: $quality);
            $size = filesize($path.'/'.$filename);
            $quality -= 5;
        } while ($size > 1024 * 1024 && $quality > 40);

        return $filename;
    }
}
