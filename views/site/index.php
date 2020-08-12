<?php

    /* @var $this yii\web\View */

    $this->title = 'My Yii Application';
    use app\widgets\Alert;
    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
    use app\assets\AppAsset;

    AppAsset::register($this)
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <p> Рубрики: </p>
                <?php foreach ($models as $model): ?>
                    <a href="/site/rubrics/<?= $model->id ?>"><?= $model->title ?></a>
                <?php endforeach; ?>

                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Место жительства</th>
                        <th>Навыки</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</div>
