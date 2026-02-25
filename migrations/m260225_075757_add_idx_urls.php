<?php

use yii\db\Migration;

class m260225_075757_add_idx_urls extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createIndex('idx_urls_url', '{{%urls}}', 'url');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropIndex('idx_urls_url', '{{%urls}}');
    }
}
