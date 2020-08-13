<?php

    /* @var $this yii\web\View */

    $this->title = $model->title;
?>
<div class="site-index">

    <?php try {
        $this->registerJsFile(Yii::$app->request->baseUrl . '/js/news.js',
                ['depends' => [\yii\web\JqueryAsset::className()]]);
    } catch (\yii\base\InvalidConfigException $e) {
    } ?>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <p> Рубрика: </p>
                <?= $model->title ?>
                <? if ($model->getParent()->one() != null) { ?>
                    <p>
                        <b>Родительская категория</b>
                        <? $parent = $model->getParent()->one() ?>

                        <a href="/site/rubrics/<?= $parent->id ?>" > <?= $parent->title ?></a>
                    </p>
                <? } ?>

                <input type="hidden" id="rubric_id" name="rubric_id" value="<?= $model->id ?>">

                <div class="body-content">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Новость</th>
                            <th>Описание</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <a type="btn btn-primary" href="/">К списку рубрик</a>
    </div>
</div>
