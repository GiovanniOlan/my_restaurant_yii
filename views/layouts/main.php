<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\widgets\Alert;
use yii\bootstrap4\Nav;
use app\assets\AppAsset;
use yii\bootstrap4\Html;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use webvimark\modules\UserManagement\UserManagementModule;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <?php if (Yii::$app->user->isSuperAdmin) : ?>
        <main role="main" class="wrapper">
            <?= $this->render('sidebar-left')
            ?>
            <div class="main-panel">
                <?= $this->render('navbar')
                ?>

                <div class="content">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </div>

        </main>
    <?php endif ?>

    <?php if (!Yii::$app->user->isSuperAdmin) : ?>
        <main class="content">
            <?= Alert::widget() ?>
            <?= $content ?>
        </main>
    <?php endif ?>





    <!-- <div class="wrapper">
        <?php // $this->render('sidebar-left') 
        ?>
        <div class="main-panel">
            {% include './navbar.html' %}
            <div class="content">
                {% block content %}{% endblock %}

            </div>
            {% include './footer.html' %}


        </div>
    </div> -->

    <!-- <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-left">&copy; My Company <?php // date('Y') 
                                                    ?></p>
            <p class="float-right"><?php // Yii::powered() 
                                    ?></p>
        </div>
    </footer> -->

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>








<body class="">

</body>