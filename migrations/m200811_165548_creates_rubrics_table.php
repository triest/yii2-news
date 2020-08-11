<?php

    use yii\db\Migration;

    /**
     * Handles the creation of table `{{%s_rubrics}}`.
     */
    class m200811_165548_creates_rubrics_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('{{%s_rubrics}}', [
                    'id' => $this->primaryKey(),
                    'title' => $this->string(),
                    'parent_id' => $this->integer()->null()->defaultValue(null)
            ]);

            $this->createIndex(
                    'parent_id',
                    's_rubrics',
                    'parent_id'
            );

            $this->addForeignKey(
                    'parent_id',
                    's_rubrics',
                    'parent_id',
                    's_rubrics',
                    'id',
                    'CASCADE'
            );
        }


        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('{{%s_rubrics}}');
        }
    }
