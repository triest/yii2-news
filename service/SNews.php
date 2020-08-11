<?php

    namespace app\service;

    use app\models\News;
    use Yii;
    use yii\db\Exception;
    use yii\db\Query;

    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 11.08.2020
     * Time: 20:51
     */
    class SNews
    {
        public function getNews(int $rubrikId)
        {
            $connection = Yii::$app->getDb();
            $command = $connection->createCommand('select n.*
from news n join
     news_rubriks nr
     on nr.news_id = n.id left join
     rubrics r
     on nr.rubric_id = r.id
where :id in (r.id, r.parent_id)', [':id' => $rubrikId]);

            try {
                return $command->queryAll();
            } catch (Exception $e) {
                return false;
            }

        }

    }