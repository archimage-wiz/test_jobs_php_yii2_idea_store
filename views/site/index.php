<?php

use yii\bootstrap5\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */

$this->title = 'Магазин замечательных идей';
?>

<div class="site-index">
    <?php if (Yii::$app->user->isGuest): ?>
        <div class="alert alert-warning">
            <p>Для доступа к контенту необходимо авторизоваться</p>
            <?= Html::a('Войти', ['site/login'], ['class' => 'btn btn-primary']) ?>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="">
                <h4>Добро пожаловать в магазин "Магазин замечательных идей".</h4>
                <div class="index-title">
                    Привет, <?= Yii::$app->user->identity->username ?>!
                    <?= Html::a('Создать идею', ['note/create'], ['class' => 'btn btn-success']) ?>
                </div>

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '@app/views/note/_idea_card',
                    'layout' => '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">{items}</div><div class="d-flex justify-content-center mt-4">{pager}</div>',
                    'itemOptions' => [
                        'class' => 'col d-flex align-items-stretch',
                    ],
                    'pager' => [
                        'options' => ['class' => 'pagination'],
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                        'activePageCssClass' => 'active',
                        'disabledPageCssClass' => 'disabled',
                        'prevPageLabel' => '<<',
                        'nextPageLabel' => '>>',
                        'maxButtonCount' => 5,
                        'hideOnSinglePage' => true,
                        'nextPageCssClass' => 'next',
                        'prevPageCssClass' => 'prev',
                    ],
                ]) ?>

            </div>
        </div>
    <?php endif; ?>
</div>