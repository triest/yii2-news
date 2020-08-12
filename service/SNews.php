<?php

    namespace app\service;

    use app\models\News;
    use app\models\Rubric;
    use phpDocumentor\Reflection\Types\Collection;
    use Yii;
    use yii\db\Exception;
    use yii\db\Query;
    use yii\helpers\ArrayHelper;

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


            /*
            $connection = Yii::$app->getDb();

            $command = $connection->createCommand('select n.*,r.parent_id
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
*/

            $item = Rubric::find()->where(['id' => $rubrikId])->one();
            // var_dump($item);
            if ($item == null) {
                return null;
            }
            $array = array();
            $array[] = $rubrikId;
            $item2 = $item->getChildren()->one();
            if ($item2 != null) {
                $array[] = $item2->id;
                while ($item2 != null) {
                    $item2 = $item2->getChildren()->one();
                    $array[] = $item2->id;
                }
            }
            $collection = array();
            foreach ($array as $item) {
                $rubrick = Rubric::find()->where(['id' => $item])->one();
                if ($rubrick != null) {
                    $news = $rubrick->getNews()->all();
                    foreach ($news as $news_item) {

                        $results = ArrayHelper::toArray($news_item, [
                                'models\News' => [
                                        'id',
                                        'title',
                                        'description',
                                ],
                        ]);
                        $collection[] = $results;
                        //  array_push($collection,$results);
                    }
                }
            }

            return $collection;
        }
    }