<?php
class GallerySeeder extends Seeder {
    public function run()
    {
        DB::table('galerias_sociales')->delete();
        DB::table('galerias_imagenes')->delete();

        SocialGallery::create(array(
            'nombre' => 'Indie Fest',
            'fecha' => new DateTime(),
            'imagen_web' => 'img/social_galleries/default/imagen_web.png'
        ));

        foreach (array(1, 2, 3, 4, 5, 6) as $k)
        {
            $image = new GalleryImage();
            $image->imagen = 'img/gallery_images/default/imagen.png';
            $image->descripcion = 'Test Image Description';

            SocialGallery::where('nombre', 'Indie Fest')->first()->images()->save($image);
        }

        SocialGallery::create(array(
            'nombre' => 'Madagascar',
            'fecha' => new DateTime(),
            'imagen_web' => 'img/social_galleries/default/imagen_web.png'
        ));

        foreach (array(1, 2, 3, 4, 5, 6) as $k)
        {
            $image = new GalleryImage();
            $image->imagen = 'img/gallery_images/default/imagen.png';
            $image->descripcion = 'Test Image Description';

            SocialGallery::where('nombre', 'Madagascar')->first()->images()->save($image);
        }

        SocialGallery::create(array(
            'nombre' => 'Limp Bizkit',
            'fecha' => new DateTime(),
            'imagen_web' => 'img/social_galleries/default/imagen_web.png'
        ));

        foreach (array(1, 2, 3, 4, 5, 6) as $k)
        {
            $image = new GalleryImage();
            $image->imagen = 'img/gallery_images/default/imagen.png';
            $image->descripcion = 'Test Image Description';

            SocialGallery::where('nombre', 'Limp Bizkit')->first()->images()->save($image);
        }
    }
} 