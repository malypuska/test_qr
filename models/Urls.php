<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

/**
 * This is the model class for table "urls".
 *
 * @property int $id
 * @property string|null $url URL
 * @property int|null $count_transition Кол-во переходов
 */
class Urls extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'urls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['url'], 'required'],
            [['url'], 'checkUrl'],
            [['url'], 'checkAccessUrl'],
            [['count_transition'], 'default', 'value' => 0],
            [['count_transition'], 'integer'],
            [['url'], 'string', 'max' => 500],
        ];
    }

    public function checkUrl($attribute, $param) {
        if (preg_match('/^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*)$/si', $this->$attribute)) {
            return true;
        }

        $this->addError('url', 'Вы ввели не корректный URL ссылки!');

        return false;
    }

    public function checkAccessUrl($attribute, $param) {
        $ch = curl_init($this->$attribute);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_exec($ch);

        $info = curl_getinfo($ch);

        if (!empty($info['http_code']) && $info['http_code'] < 400) {
            return true;
        }

        $this->addError('url', 'Данный URL не доступен!');

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'url' => 'URL',
            'count_transition' => 'Кол-во переходов',
        ];
    }

    public function getQr() {
        $qrCode = new QrCode($this->transitionUrl);

        $writer = new PngWriter();
        return $writer->write($qrCode)->getString();
    }

    public function getTransitionUrl() {
        return Url::toRoute(['urls/transition', 'id' => $this->id], ['target' => '_blank']);
    }
    
    public function getLogs() {
        return $this->hasMany(Logs::class, ['url_id' => 'id']);
    }
}
