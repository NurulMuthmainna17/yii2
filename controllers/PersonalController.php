<?php

namespace app\controllers;

use app\models\personal;
use app\models\personalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonalController implements the CRUD actions for personal model.
 */
class PersonalController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all personal models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new personalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single personal model.
     * @param int $id_personal Id Personal
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_personal)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_personal),
        ]);
    }

    /**
     * Creates a new personal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new personal();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_personal' => $model->id_personal]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing personal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_personal Id Personal
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_personal)
    {
        $model = $this->findModel($id_personal);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_personal' => $model->id_personal]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing personal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_personal Id Personal
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_personal)
    {
        $this->findModel($id_personal)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the personal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_personal Id Personal
     * @return personal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_personal)
    {
        if (($model = personal::findOne(['id_personal' => $id_personal])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
