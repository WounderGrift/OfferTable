<?php

/** @var yii\web\View $this */
/** @var object $offers */
/** @var object $dataProvider */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Офферы';

echo LinkPager::widget([
    'pagination' => $dataProvider->pagination,
]);
?>

<div class="offer-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    Решил сделать не через аякс, а виджетами yii: сортировку, пагинацию-->
<!--    Поиск сделал через форму-->
    <form method="get" class="search-form" action="<?= Url::to(['offer-page/index']) ?>" style="display: flex; align-items: center; margin: 20px 0;">
        <input type="text" name="search" placeholder="Поиск" class="input_search" value="<?= Yii::$app->request->get('search') ?>">
        <button type="submit" class="button_search"><i class="fas fa-search" style="margin-right: 5px;"></i></button>
    </form>

    <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => [
                'class' => 'table table-bordered',
                'style' => 'text-align: center;'
            ],
            'columns' => [
                'id',
                'title',
                'email',
                'phone',
                'created_at',
                [
                    'header' => Html::a('<i class="fas fa-plus" style="float:left;"></i>', '/web/offer-page/create', [
                            'class' => 'btn btn-info',
                            'title' => 'Создать',
                        ]),
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<i class="fas fa-eye"></i>', Url::to(['view', 'id' => $model->id]), [
                                'class' => 'btn btn-info',
                                'title' => 'Просмотреть',
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<i class="fas fa-trash"></i>', $url, [
                                'class' => 'btn btn-danger',
                                'title' => 'Удалить',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить этот оффер?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                ],
            ],
        ]);
    ?>
</div>