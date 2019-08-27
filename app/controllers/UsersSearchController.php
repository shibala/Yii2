<?php

namespace app\controllers;

use app\base\BaseController;
use app\components\UserAuthComponent;
use Yii;
use app\models\Users;
use app\models\UsersSearch;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersSearchController implements the CRUD actions for Users model.
 */
class UsersSearchController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = \Yii::$container->get(UsersSearch::class);;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = \Yii::$container->get(Users::class);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionChangePass()
    {

        $model = $this->findModel(\Yii::$app->session['__id']);

        if ($model->load(Yii::$app->request->post())) {

            /** @var UserAuthComponent $comp */
            $comp = Yii::$app->auth;

            if (!$comp->validatePassword($model->password, $model->password_hash)) {
                $model->addError('password', 'Неверный пароль!');
                return false;
            }

            if (!$model->validate(['new_password', 'new_password_repeat'])) {
                return false;
            }

            $model->password_hash = $comp->hashPassword($model->new_password);


            if ($model->save()) {
                \Yii::$app->session->addFlash('success', 'Пароль успешно изменен ' . $model->password_hash);
                return $this->redirect(['/users-search/index']);
            } else {
                \Yii::$app->session->addFlash('success', 'Ошибка изменения пароля ');
            }


        }

        return $this->render('change-pass', [
            'model' => $model,
        ]);







        /*$id = \Yii::$app->session['__id'];*/

        /** @var UserAuthComponent $comp */
        /*$comp = \Yii::$app->auth;


        $model = $this->findModel($id);

        if (\Yii::$app->request->isPost) {

            $model = $comp->getModel(\Yii::$app->request->post());



            if ($comp->changeUserPassword($model)) {
                \Yii::$app->session->addFlash('success', 'Пароль успешно изменен '.$model->password_hash);
            }

            return $this->redirect(['/users-search/index']);
        }

        return $this->render('change-pass', [
            'model' => $model,
        ]);*/
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
