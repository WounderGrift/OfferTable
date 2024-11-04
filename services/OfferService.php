<?php

namespace app\services;

use app\models\Offers;
use Throwable;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\helpers\Json;
use yii\helpers\Url;

class OfferService
{
    public function getOffers($search): ActiveDataProvider
    {
        $searchModel = new Offers();
        return $searchModel->search($search);
    }

    public function getOffer($offerId): ?Offers
    {
        return Offers::findOne($offerId);
    }

    /**
     * @throws Exception
     */
    public function createOffer($requestData): string
    {
        $data  = JSON::decode($requestData);
        $model = new Offers();

        $model->scenario = 'create';
        $model->setAttributes($data, false);

        if ($model->validate() && $model->save()) {
            Yii::$app->session->setFlash('success', 'Оффер успешно создан');

            return JSON::encode([
                'success' => true,
                'message' => 'Успешно сохранено',
                'url' => Url::to(['offer-page/view', 'id' => $model->id])
            ]);
        }

        throw new Exception(JSON::encode([
            'success' => false,
            'error' => [
                'code' => 422,
                'message' => $model->getErrors()
            ]])
        );
    }

    /**
     * @throws Exception
     */
    public function updateOffer($data): string
    {
        $data  = JSON::decode($data);
        $model = Offers::findOne($data['id']);

        if ($model) {
            $model->scenario = 'update';
            $model->setAttributes($data, false);

            if ($model->validate() && $model->save()) {
                return JSON::encode([
                    'success' => true,
                    'message' => 'Успешно сохранено',
                    'model' => $model
                ]);
            }

            throw new Exception(JSON::encode([
                'success' => false,
                'error' => [
                    'code' => 422,
                    'message' => $model->getErrors()
                ]])
            );
        } else {
            throw new Exception(JSON::encode([
                'success' => false,
                'error' => [
                    'code' => 422,
                    'message' => 'Оффер не найден'
                ]]));
        }
    }

    /**
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function deleteOffer($id): array
    {
        $model = Offers::findOne($id);

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Оффер успешно удален');
            return [
                'success' => true
            ];
        } else {
            Yii::$app->session->setFlash('error', 'Оффер не найден');
            return[
                'success' => false
            ];
        }
    }
}