<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CatMenuItem */

$this->title = 'Create Cat Menu Item';
$this->params['breadcrumbs'][] = ['label' => 'Cat Menu Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cat-menu-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
