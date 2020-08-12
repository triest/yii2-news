<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    public function getRubric(){
        // return $this->hasMany(Rubric::class,['news_id','id']);
        return $this->hasMany(News::className(), ['id' => 'rubric_id'])
                ->viaTable('news_rubriks', ['news_id' => 'id']);
    }

    /**
     * @param $rubrics_id
     * @return bool
     */
    public function saveNews(int $rubrics_id)
    {

        if(!Rubric::find()->where( [ 'id' => $rubrics_id ] )->exists()){

            return false;
        }else {
            return $this->save();
        }
    }
}
