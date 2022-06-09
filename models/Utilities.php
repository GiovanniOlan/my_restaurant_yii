<?php

namespace app\models;

use Yii;

class Utilities
{

    public static function uploadImage($path, $image)
    {
        //instanciamos la imagen
        $ext = explode(".", $image->name); //obtenemos la extension de la img
        $ext = end($ext); //obtenemos la extension de la img
        //guardamos la imagen con otro nombre para evitar repetir nombres
        $random_name = Yii::$app->security->generateRandomString() . ".{$ext}";
        //variable para guardar la ruta donde se guarda la imagen
        $path_upload_short = $path . $random_name;
        $path_upload = Yii::$app->basePath . '/web' . $path_upload_short;
        //Condicionamos si se guardo la ruta y los datos al modelo
        if ($image->saveAs($path_upload)) {
            return $path_upload_short;
        } else {
            return '';
        }
    }
}
