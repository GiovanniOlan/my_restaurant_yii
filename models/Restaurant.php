<?php

namespace app\models;

use Yii;
use yii\bootstrap4\Html;

/**
 * This is the model class for table "RESTAURANT".
 *
 * @property int $id ID
 * @property int $state Estado
 * @property string $res_name Nombre
 * @property string $res_description Descripción
 * @property string|null $res_logo Logo
 * @property string $res_slogan Slogan
 * @property string|null $res_mainimage Imagen Principal
 * @property int $res_fkuserowner Dueño Del Restaurante
 *
 * @property CATMENU[] $cATMENUs
 * @property CLIENT[] $cLIENTs
 * @property EMPLEADO[] $eMPLEADOs
 * @property USEROWNER $resFkuserowner
 * @property TICKET[] $tICKETs
 */
class Restaurant extends \yii\db\ActiveRecord
{
    public $img_mainimage;
    public $img_logo;

    public static function tableName()
    {
        return 'RESTAURANT';
    }

    public function rules()
    {
        return [
            [['state', 'res_name', 'res_description', 'res_slogan', 'res_fkuserowner'], 'required'],
            [['state', 'res_fkuserowner'], 'integer'],
            // [['img_mainimage'], 'safe'],
            [['img_mainimage'], 'file', 'extensions'   => 'jpg, jpeg, png'],
            [['img_mainimage'], 'file', 'maxSize'      => '500000'],
            // [['img_logo'], 'safe'],
            [['img_logo'], 'file', 'extensions'   => 'jpg, jpeg, png'],
            [['img_logo'], 'file', 'maxSize'      => '500000'],
            [['res_description'], 'string'],
            [['res_name'], 'string', 'max' => 30],
            [['res_logo', 'res_mainimage'], 'string', 'max' => 255],
            [['res_slogan'], 'string', 'max' => 50],
            [['res_fkuserowner'], 'exist', 'skipOnError' => true, 'targetClass' => UserOwner::className(), 'targetAttribute' => ['res_fkuserowner' => 'id']],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id'              => 'ID',
            'state'           => 'Estado',
            'res_name'        => 'Nombre',
            'res_description' => 'Descripción',
            'res_logo'        => 'Logo',
            'img_logo'        => 'Logo',
            'res_slogan'      => 'Slogan',
            'res_mainimage'   => 'Imagen Principal',
            'img_mainimage'   => 'Imagen Principal',
            'res_fkuserowner' => 'Dueño Del Restaurante',
        ];
    }

    public function getCATMENUs()
    {
        return $this->hasMany(CatMenu::className(), ['catmen_fkrestaurant' => 'id']);
    }

    public function getCLIENTs()
    {
        return $this->hasMany(Client::className(), ['cli_fkrestaurant' => 'id']);
    }

    public function getEMPLEADOs()
    {
        return $this->hasMany(Empleado::className(), ['emp_fkrestaurant' => 'id']);
    }

    public function getResFkuserowner()
    {
        return $this->hasOne(Userowner::className(), ['id' => 'res_fkuserowner']);
    }

    public function getTICKETs()
    {
        return $this->hasMany(Ticket::className(), ['tic_fkrestaurant' => 'id']);
    }

    public function getLogoHtml($width = 30, $height = 30)
    {
        return Html::img($this->getLogoUrl(), ['alt' => $this->res_name, 'width' => "{$width}%", 'height' => "{$height}%"]);
    }

    public function getLogoUrl()
    {
        return (empty($this->res_logo) ? "/upload/images/default/restaurant-logo.png" : "{$this->res_logo}");
    }

    public function getMainImageHtml()
    {
        return Html::img($this->getMainImageUrl(), ['alt' => $this->res_name]);
    }

    public function getMainImageUrl()
    {
        return (empty($this->res_mainimage) ? "/upload/images/default/restaurant-img-main.png" : "{$this->res_mainimage}");
    }
}
