<?php

    use yii\db\Migration;

    /**
     * Handles the creation of table `{{%s_articles}}`.
     */
    class m200811_165216_creates_articles_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('{{%s_articles}}', [
                    'id' => $this->primaryKey(),
                    'title' => $this->string(),
                    'description' => $this->text(),
            ]);
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('{{%s_articles}}');
        }
    }
