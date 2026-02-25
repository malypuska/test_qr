<?php

use yii\db\Migration;

class m260225_074835_creat_table_logs extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%logs}}', [
            'id' => $this->primaryKey(),
            'url_id' => $this->integer()->comment('ID URL'),
            'ip' => $this->string()->comment('IP с которого перешли'),
            'transition_at' => $this->dateTime()->comment('Дата перехода'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%logs}}');
    }
}
