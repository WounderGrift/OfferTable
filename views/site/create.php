<?php

/** @var yii\web\View $this */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Создать новый оффер';
?>

<div class="offer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="error">
        <h3></h3>
    </div>

    <table class="table table-bordered" style="text-align: center;">
        <tr>
            <th>Название</th>
            <td>
                <input type="text" class="form-control offer-title-input" value=""
                       style="text-align: center;">
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                <input type="email" class="form-control offer-email-input" value=""
                       style="text-align: center;">
            </td>
        </tr>
        <tr>
            <th>Телефон</th>
            <td>
                <input type="text" class="form-control offer-phone-input" value=""
                       style="text-align: center;">
            </td>
        </tr>
        <tr>
        <tr>
            <th></th>
            <td>
                <button class="btn btn-success save-btn"><i class="fas fa-save"></i></button>
            </td>
        </tr>
    </table>
</div>

<script type="module" src="../../web/js/offer-page/create.js"></script>
