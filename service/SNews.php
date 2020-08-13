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
            $item = Rubric::find()->where(['id' => $rubrikId])->one();
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
                    }
                }
            }

            return $this->my_array_unique($collection);
        }

        function my_array_unique($array, $keep_key_assoc = false)
        {
            $duplicate_keys = array();
            $tmp = array();

            foreach ($array as $key => $val) {
                // convert objects to arrays, in_array() does not support objects
                if (is_object($val)) {
                    $val = (array)$val;
                }

                if (!in_array($val, $tmp)) {
                    $tmp[] = $val;
                } else {
                    $duplicate_keys[] = $key;
                }
            }

            foreach ($duplicate_keys as $key) {
                unset($array[$key]);
            }

            return $keep_key_assoc ? $array : array_values($array);
        }
    }