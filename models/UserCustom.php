<?php

namespace app\models;

use Yii;
use webvimark\modules\UserManagement\models\User;

/**
 * This is the model class for table "USER_CUSTOM".
 *
 * @property int $id ID
 * @property string $usu_nombre Nombre
 * @property string $usu_paterno Apellido Paterno
 * @property string $usu_materno Apellido Materno
 * @property string $usu_datebirth Dia De Nacimiento
 * @property string|null $usu_photo Foto De Perfil
 * @property int $usu_fkgender Género
 * @property int $usu_fkuser User
 *
 * @property CLIENT[] $cLIENTs
 * @property EMPLEADO[] $eMPLEADOs
 * @property USEROWNER[] $uSEROWNERs
 * @property CATGENDER $usuFkgender
 * @property User $usuFkuser
 */
class UserCustom extends \yii\db\ActiveRecord
{


    public static function getUserCustom($id_user)
    {
        return UserCustom::find()->where(['usu_fkuser' => $id_user])->one();
    }

    public static function tableName()
    {
        return 'USER_CUSTOM';
    }


    public function rules()
    {
        return [
            [['usu_nombre', 'usu_paterno', 'usu_materno', 'usu_datebirth', 'usu_fkgender', 'usu_fkuser'], 'required'],
            [['usu_datebirth'], 'safe'],
            [['usu_fkgender', 'usu_fkuser'], 'integer'],
            [['usu_nombre', 'usu_paterno', 'usu_materno'], 'string', 'max' => 30],
            [['usu_photo'], 'string', 'max' => 255],
            [['usu_fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usu_fkuser' => 'id']],
            [['usu_fkgender'], 'exist', 'skipOnError' => true, 'targetClass' => CatGender::className(), 'targetAttribute' => ['usu_fkgender' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usu_nombre' => 'Nombre',
            'usu_paterno' => 'Apellido Paterno',
            'usu_materno' => 'Apellido Materno',
            'usu_datebirth' => 'Dia De Nacimiento',
            'usu_photo' => 'Foto De Perfil',
            'usu_fkgender' => 'Género',
            'usu_fkuser' => 'User',
        ];
    }

    /**
     * Gets query for [[CLIENTs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['cli_fkusercustom' => 'id']);
    }

    /**
     * Gets query for [[EMPLEADOs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::className(), ['emp_fkusercustom' => 'id']);
    }

    /**
     * Gets query for [[USEROWNERs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserOwners()
    {
        return $this->hasMany(UserOwner::className(), ['usu_fkusercustom' => 'id']);
    }

    /**
     * Gets query for [[UsuFkgender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuFkgender()
    {
        return $this->hasOne(CatGender::className(), ['id' => 'usu_fkgender']);
    }

    /**
     * Gets query for [[UsuFkuser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuFkuser()
    {
        return $this->hasOne(User::className(), ['id' => 'usu_fkuser']);
    }

    public function getPhotoUrl()
    {
        return (empty($this->usu_photo) ? "/upload/images/default/user-default.png" : $this->usu_photo);
    }
}
