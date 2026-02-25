<?php

use yii\db\Migration;

class m260225_074828_creat_table_urls extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%urls}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(500)->comment('URL'),
            'count_transition' => $this->integer()->defaultValue(0)->comment('Кол-во переходов'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%urls}}');
    }
}
