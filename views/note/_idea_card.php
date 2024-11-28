<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;

/** @var app\models\Note $model */
?>

<div class="idea-card card">
    <div class="card-body">
        <h5 class="card-title"><?= Html::encode($model->title) ?></h5>
        <div class="card-text">
            <?= StringHelper::truncate(Html::encode($model->text), 100, '...') ?>
        </div>
        <div class="card-footer">
            <small class="text-muted">
                Создано: <?= Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i') ?>
            </small>
            <div>
                <?= Html::a('Подробнее', ['note/view', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary d-block mx-auto text-center']) ?>
            </div>
        </div>
    </div>
</div>