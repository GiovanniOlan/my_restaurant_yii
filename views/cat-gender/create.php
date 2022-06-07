<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CatGender */

$this->title = 'Create Cat Gender';
$this->params['breadcrumbs'][] = ['label' => 'Cat Genders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cat-gender-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
