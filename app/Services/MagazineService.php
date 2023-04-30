<?php

namespace App\Services;

use App\Exceptions\SaveMagazineExeptions;
use App\Models\Magazine;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MagazineService
{
    public function saveMagazine(Magazine $magazine,?UploadedFile $file): Magazine
    {
        if (is_null($file)) {
            $oldPhotoPath = $magazine->getPhotoPath();
            if(!empty($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);

                $magazine->setPhotoPath(null);
                $magazine->setPhotoName(null);
            }
            $magazine->save();

            return $magazine;
        }

        $photoPath = $file->store('uploads','public');
        if (!$photoPath) {
            throw new SaveMagazineExeptions("Don't save photo to uploads");
        }

        try {
            $photoName = $file->getClientOriginalName();

            $oldPhotoPath = $magazine->getPhotoPath();
            if (!empty($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);
            }

            $magazine->setPhotoPath($photoPath);
            $magazine->setPhotoName($photoName);

            $magazine->save();
        } catch (\Exception $e) {
            Storage::disk('public')->delete($photoPath);
            throw new SaveMagazineExeptions("Don't save notebook with photo",0, $e);
        }
        return $magazine;
    }
}
