<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CatMenu */

$this->title = 'Create Cat Menu';
$this->params['breadcrumbs'][] = ['label' => 'Cat Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cat-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
