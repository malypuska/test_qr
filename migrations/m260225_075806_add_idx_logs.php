<?php

use yii\db\Migration;

class m260225_075806_add_idx_logs extends Migration {

    public function safeUp() {
        $this->createIndex('idx_urls_logs', '{{%logs}}', 'url_id');
        $this->createIndex('idx_urls_ip', '{{%logs}}', 'ip');
        $this->createIndex('idx_urls_transition_at', '{{%logs}}', 'transition_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropIndex('idx_urls_transition_at', '{{%logs}}');
        $this->dropIndex('idx_urls_ip', '{{%logs}}');
        $this->dropIndex('idx_urls_logs', '{{%logs}}');
    }
}
