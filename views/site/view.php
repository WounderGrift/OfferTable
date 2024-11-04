<?php

/** @var yii\web\View $this */
/** @var object $offer */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Информация об оффере';
?>

<div class="offer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="error">
        <h3></h3>
    </div>

    <?php if ($offer): ?>
        <table class="table table-bordered" style="text-align: center;">
            <tr>
                <th>ID</th>
                <td>
                    <span class="offer-id"><?= $offer->id ?></span>
                </td>
            </tr>
            <tr>
                <th>Название</th>
                <td>
                    <span class="offer-title"><?= $offer->title ?></span>
                    <input type="text" class="form-control offer-title-input" value="<?= $offer->title ?>" style="display: none; text-align: center;">
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>
                    <span class="offer-email"><?= $offer->email ?></span>
                    <input type="email" class="form-control offer-email-input" value="<?= $offer->email ?>" style="display: none; text-align: center;">
                </td>
            </tr>
            <tr>
                <th>Телефон</th>
                <td>
                    <span class="offer-phone"><?= $offer->phone ?></span>
                    <input type="text" class="form-control offer-phone-input" value="<?= $offer->phone ?>" style="display: none; text-align: center;">
                </td>
            </tr>
            <tr>
                <th>Дата создания</th>
                <td>
                    <span class="offer-created-at"><?= $offer->created_at ?></span>
                </td>
            <tr>
                <th></th>
                <td>
                    <button class="btn btn-warning edit-btn"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-success save-btn" style="display: none;"><i class="fas fa-save"></i></button>

                    <?=
                        Html::a('<i class="fas fa-trash"></i>', Url::to(['delete', 'id' => $offer->id]), [
                            'class' => 'btn btn-danger',
                            'title' => 'Удалить',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить этот оффер?',
                                'method' => 'post',
                            ],
                        ]);
                    ?>
                </td>
            </tr>
        </table>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            Запрашиваемый оффер не найден.
        </div>
    <?php endif ?>
</div>

<script type="module" src="../../web/js/offer-page/view.js"></script>
