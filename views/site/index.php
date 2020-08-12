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

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <p> Рубрики: </p>
                <?php foreach ($models

                    as $model): ?>
                <ul>
                    <li>
                        <?= $model->title ?>
                        <? $childrens = $model->getChildren()->all() ?>
                        <? $count = 0 ?>
                        <? foreach ($childrens as $children) { ?>
                            <? while ($children != null) { ?>
                                <? $count++ ?>
                                <ul>
                                <li>
                                <?= $children->title ?>
                                <?
                                $children = $children->getChildren()->one();
                            } ?>
                            <? for ($i = 0;
                                    $i < $count;
                                    $i++) { ?>
                                </li>
                                </ul>
                            <? } ?>
                        <? } ?>
                    </li>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
</div>
