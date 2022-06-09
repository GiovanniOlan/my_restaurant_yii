<?php

use yii\helpers\Html;
use app\models\CatMenu;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CatMenuItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cat-menu-item-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'card-body row']]); ?>

    <?= $form->field($cat_menu_item, 'catmenite_name', ['options' => ['class' => 'col-6']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($cat_menu_item, 'catmenite_for', ['options' => ['class' => 'col-6']])->textInput() ?>

    <?= $form->field($cat_menu_item, 'catmenite_price', ['options' => ['class' => 'col-6']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($cat_menu_item, 'catmenite_fkcatmenu', ['options' => ['class' => 'col-6']])->widget(Select2::classname(), [
        'data' => ArrayHelper::map(CatMenu::find()->where(['catmen_fkrestaurant' => $restaurant->id, 'state' => 1])->all(), 'id', 'catmen_name'),
        'language' => 'es',
        'options' => ['placeholder' => 'Seleccione un Grupo ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%'
        ],
    ]); ?>

    <?= $form->field($cat_menu_item, 'catmenite_description', ['options' => ['class' => 'col-6']])->textarea(['rows' => 6]) ?>


    <?= $form->field($cat_menu_item, 'img', ['options' => ['class' => 'col-6']])->widget(
        FileInput::classname(),
        [
            'options'       => ['accept' => 'image/*', 'class' => 'form-control black form-crear'],
            'language'      => 'es',
            'pluginOptions' => [
                'allowedFileExtensions' =>  ['jpg', 'jpeg', 'png'],
                'initialPreview'        => (empty($cat_menu_item->catmenite_image) ? false : [$cat_menu_item->getImageUrl()]),
                'initialPreviewAsData'  => true,
                'showCaption'           => false,
                'showRemove'            => false,
                'showCancel'            => false,
                'showUpload'            => false,
                'browseClass'           => 'btn btn-primary btn-block',
                'browseIcon'            => '<i class="fas fa-camera"></i> ',
                'browseLabel'           =>  'Seleccione una foto',
            ],
        ]
    );
    ?>


    <div class="col-md-12">
        <div class="text-center">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>