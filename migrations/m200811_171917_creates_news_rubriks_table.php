<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%s_news_rubriks}}`.
 */
class m200811_171917_creates_news_rubriks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news_rubriks}}', [
            'id' => $this->primaryKey(),
            'news_id'=>$this->integer()->null()->defaultValue(null),
            'rubric_id'=>$this->integer()->null()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news_rubriks}}');
    }
}
