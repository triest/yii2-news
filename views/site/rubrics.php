<?php

    /* @var $this yii\web\View */

    $this->title = 'My Yii Application';
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
                <p> Рубрики: </p>
               <?= $model->title ?>


                <div class="body-content">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Категории</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
