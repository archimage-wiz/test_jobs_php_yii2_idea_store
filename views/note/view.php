<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Note $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Идеи', 'url' => ['site/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="note-view">
    <div class="card">
        <div class="card-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <p class="card-text"><?= Html::encode($model->text) ?></p>
                </div>
                <div class="col-md-4">
                    <div class="note-metadata">
                        <p>
                            <strong>Создано:</strong> 
                            <?= Yii::$app->formatter->asDatetime($model->created_at) ?>
                        </p>
                        <?php if ($model->created_at != $model->updated_at): ?>
                            <p>
                                <strong>Обновлено:</strong> 
                                <?= Yii::$app->formatter->asDatetime($model->updated_at) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer">
            <div class="btn-group">
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить эту идею?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Назад к списку', ['site/index'], ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
    </div>
</div>