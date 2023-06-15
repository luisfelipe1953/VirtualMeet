<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * Guarda la imagen en el almacenamiento
     *
     * @param mixed $file
     * @return string
     */
    public function create(mixed $file): string
    {
        $path = 'img/speakers';

        if (!Storage::exists($path)) {
            Storage::disk('public')->makeDirectory($path, 0755, true);
        }
        $nameImage = md5(uniqid(rand(), true));
        $imagen_png = Image::make($file)->fit(800, 800)->encode('png', 80);
        $imagen_webp = Image::make($file)->fit(800, 800)->encode('webp', 80);

        Storage::disk('public')->put($path . '/' . $nameImage . '.png', (string)$imagen_png, 'public');
        Storage::disk('public')->put($path . '/' . $nameImage . '.webp', (string)$imagen_webp, 'public');

        return $nameImage;
    }

    /**
     * Elimina la imagen del almacenamiento
     *
     * @param Model $model
     * @return void
     */
    private function deleteStorage(string $imgDelete): void
    {
        $path_png = public_path($imgDelete . '.png');
        if (file_exists($path_png)) {
            unlink($path_png);
        }
        
        $path_webp = public_path($imgDelete . '.webp');
        if (file_exists($path_webp)) {
            unlink($path_webp);
        }
    }

    /**
     * Eliminar registro de imagen
     *
     * @param Model $model
     * @return void
     */
    public function delete(string $imgDelete): void
    {
        $this->deleteStorage($imgDelete);
    }


    public function update(string $imgDelete, mixed $file): string
    {
        if ($file) {
            $this->deleteStorage($imgDelete);

            $nameImage = $this->create($file);

            return $nameImage;
        }
    }
}
