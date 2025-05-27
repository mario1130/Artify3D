<?php
namespace App\Helpers;

use Intervention\Image\Facades\Image;

class ImageHelper
{
    public static function generateInitialAvatar($name, $size = 100)
    {
        $initial = strtoupper(substr($name, 0, 1)); // Obtener la primera letra del nombre

        // Generar un color único basado en el hash del nombre
        $hash = md5($name);
        $backgroundColor = '#' . substr($hash, 0, 6); // Usar los primeros 6 caracteres del hash

        // Crear el lienzo cuadrado con el fondo dinámico
        $image = Image::canvas($size, $size, $backgroundColor);

        // Agregar la inicial al centro del lienzo
        $image->text($initial, $size / 2, $size / 2, function ($font) use ($size) {
            $font->file(public_path('fonts/arial.ttf')); // Ruta a la fuente
            $font->size($size / 2);
            $font->color('#FFFFFF'); // Texto blanco
            $font->align('center');
            $font->valign('center');
        });

        // Crear una máscara circular
        $mask = Image::canvas($size, $size);
        $mask->circle($size, $size / 2, $size / 2, function ($draw) {
            $draw->background('#FFFFFF'); // Círculo blanco
        });

        // Aplicar la máscara circular al lienzo
        $image->mask($mask, true);

        return base64_encode($image->encode('png')); // Retorna la imagen en base64
    }
}