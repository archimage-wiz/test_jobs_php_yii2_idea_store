<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Note;
use yii\filters\AccessControl;

class NoteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Только для авторизованных
                    ],
                ],
            ],
        ];
    }

    public function actionView($id)
    {
        $model = Note::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('Идея не найдена, создай свою!');
        }
        return $this->render('view', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Note::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('Идея не найдена');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Идея обновлена');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Note::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('Идея не найдена');
        }

        $model->delete();
        Yii::$app->session->setFlash('success', 'Идея удалена');
        return $this->redirect(['site/index']);
    }

    public function actionCreate()
    {
        $model = new Note();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Идея создана');
            return $this->redirect(['site/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}