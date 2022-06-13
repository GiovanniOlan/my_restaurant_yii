<?php

namespace app\models;

class Reporte extends \yii\db\ActiveRecord
{
    public $fechaStart;
    public $fechaEnd;

    public function rules()
    {
        return [
            [['fechaStart', 'fechaEnd'], 'required'],
            [['fechaStart', 'fechaEnd'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'fechaStart' => 'Fecha Inicial',
            'fechaEnd'   => 'Fecha Final',
        ];
    }
}
