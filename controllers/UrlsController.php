<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\bootstrap5\ActiveForm;
use yii\web\NotFoundHttpException;
use app\models\Urls;
use app\models\Logs;

class UrlsController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionValidation() {
        $model = new Urls();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }

        return ActiveForm::validate($model);
    }

    public function actionAddUrl() {
        $model = new Urls();
        $this->layout = null;

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->save()) {
                    return $this->renderPartial('view', ['model' => $model], true);
                }
            }
        }

        return null;
    }

    public function actionView($id) {
        $model = $this->findModel($id);

        return $this->render('view', ['model' => $model]);
    }

    public function actionTransition($id) {
        $model = $this->findModel($id);
        $model->count_transition++;
        if ($model->save(false, ['count_transition'])) {
            $logs = new Logs(['url_id' => $model->id]);
            if ($logs->save()) {
                return $this->redirect($model->url, 301);
            }
        }
        throw new NotFoundHttpException('Что-то пошло не так!');
    }

    protected function findModel($id) {
        if (($model = Urls::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Что-то пошло не так!');
    }
}
