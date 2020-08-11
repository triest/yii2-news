<?php
    namespace app\service;
    use app\models\Article;
    use app\models\Rubric;

    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 11.08.2020
     * Time: 20:51
     */

    class SRubrik
    {
        public function getAll(){
            return Rubric::find()->all();
        }

    }