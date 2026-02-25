<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property int|null $url_id ID URL
 * @property string|null $ip IP с которого перешли
 * @property string|null $transition_at Дата перехода
 */
class Logs extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['url_id'], 'required'],
            [['url_id'], 'integer'],
            [['transition_at'], 'safe'],
            [['ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'url_id' => 'Url ID',
            'ip' => 'Ip',
            'transition_at' => 'Дата перехода',
        ];
    }

    public function beforeSave($insert) {
        if ($insert) {
            $this->ip = $this->_getClientIp();
            $this->transition_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }

    private function _getClientIp() {
        $value = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $value = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $value = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $value = $_SERVER['REMOTE_ADDR'];
        }

        return $value;
    }
}
