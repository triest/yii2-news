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

            <? listen($models) ?>

            <?
                function listen($models)
                {

                    echo "<ul>";
                    foreach ($models as $item) {
                        echo "<li>";
                        echo "$item->title ";
                        if($item!=null && $item->getChildren()->all()!=null){
                            listen($item->getChildren()->all());
                        }
                        echo "</li>";
                    }
                    echo "</ul>";
                }
            ?>
        </div>
    </div>

</div>
