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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <p> Рубрики: </p>
                <?= $model->title ?>
                <? if ($model->getParent()->one() != null) { ?>
                    <p>
                        <b>Родительская категория</b>
                        <? $parent = $model->getParent()->one() ?>

                        <a href="/site/rubrics/<?= $parent->id ?>" +> <?= $parent->title ?></a>
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

    </div>
</div>
