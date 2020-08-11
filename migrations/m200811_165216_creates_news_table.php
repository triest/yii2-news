<?php

    use yii\db\Migration;

    /**
     * Handles the creation of table `{{%s_articles}}`.
     */
    class m200811_165216_creates_news_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('{{news}}', [
                    'id' => $this->primaryKey(),
                    'title' => $this->string()->notNull(),
                    'description' => $this->text()->notNull(),
            ]);
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('{{%news}}');
        }
    }
