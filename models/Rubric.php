<?php

    namespace app\models;

    use Yii;

    /**
     * This is the model class for table "rubrics".
     *
     * @property int $id
     * @property string|null $title
     * @property int|null $parent_id
     *
     * @property Rubric $parent
     * @property Rubric[] $rubrics
     */
    class Rubric extends \yii\db\ActiveRecord
    {
        /**
         * {@inheritdoc}
         */
        public static function tableName()
        {
            return 'rubrics';
        }

        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                    [['parent_id'], 'integer'],
                    [['title'], 'string', 'max' => 255],
                    [
                            ['parent_id'],
                            'exist',
                            'skipOnError' => true,
                            'targetClass' => Rubric::className(),
                            'targetAttribute' => ['parent_id' => 'id']
                    ],
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
                    'parent_id' => 'Parent ID',
            ];
        }

        /**
         * Gets query for [[Parent]].
         *
         * @return \yii\db\ActiveQuery
         */
        public function getParent()
        {
            return $this->hasOne(Rubric::className(), ['id' => 'parent_id']);
        }

        /**
         * Gets query for [[Rubrics]].
         *
         * @return \yii\db\ActiveQuery
         */
        public function getChildren()
        {
            return $this->hasMany(Rubric::className(), ['parent_id' => 'id']);
        }

        public static function getRoot(){
            $query=Rubric::find()
                    ->where(['parent_id'=>null])->all();
            return $query;
        }

        public function getNews()
        {
            // return $this->hasMany(Rubric::class,['news_id','id']);
            return $this->hasMany(News::className(), ['id' => 'news_id'])
                    ->viaTable('news_rubriks', ['rubric_id' => 'id']);
        }

        public static function getItem($id): Rubric
        {
            return Rubric::findOne($id);
        }


    }
