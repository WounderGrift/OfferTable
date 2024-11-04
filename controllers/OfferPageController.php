<?php

namespace app\controllers;

use app\services\OfferService;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\Response;

//Контроллер должен быть тонким, реализацию спрятал в сервис
class OfferPageController extends Controller
{
    private OfferService $service;
    public function __construct($id, $module, OfferService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $search = Yii::$app->request->queryParams["search"] ?? null;

        if (isset(Yii::$app->request->queryParams["search"]) && Yii::$app->request->queryParams["search"] == '')
        {
            return $this->redirect(['/']);
        }

        return $this->render('/site/index', [
            'dataProvider' => $this->service->getOffers($search),
        ]);
    }

    public function actionView()
    {
        $offerId = Yii::$app->request->queryParams['id'] ?? null;

        if (!$offerId)
            return $this->redirect('/site/index');

        return $this->render('/site/view', [
            'offer' => $this->service->getOffer($offerId),
        ]);
    }

    /**
     * @throws Exception
     */
    public function actionCreate(): string
    {
        if (Yii::$app->request->isGet) {
            return $this->render('/site/create');
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->rawBody;
            return $this->service->createOffer($requestData);
        }

        return $this->render('/site/create');
    }

    /**
     * @throws Exception
     */
    public function actionUpdate(): string
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $requestData = Yii::$app->request->rawBody;
        return $this->service->updateOffer($requestData);
    }

    /**
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->service->deleteOffer($id);
        return $this->redirect('/site/index');
    }
}