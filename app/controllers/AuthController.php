<?php
/**
 * Created by PhpStorm.
 */

namespace app\controllers;


use app\components\UserAuthComponent;
use yii\web\Controller;

class AuthController extends Controller
{
    /**
     * @return string
     */
    public function actionSignUp()
    {
        /** @var UserAuthComponent $comp */
        $comp = \Yii::$app->auth;

        $model = $comp->getModel(\Yii::$app->request->post());

        if (\Yii::$app->request->isPost) {

            if ($comp->createNewUser($model)) {
                \Yii::$app->session->addFlash('success', 'Пользователь успешно зарегистрирован с id '.$model->id);
            }

            return $this->redirect(['/auth/sign-in']);
        }

        return $this->render('signup', ['model' => $model]);
    }

    public function actionSignIn()
    {

        /** @var UserAuthComponent $comp */
        $comp = \Yii::$app->auth;

        $model = $comp->getModel(\Yii::$app->request->post());
        $model->setScenario($model::SCENARIO_SIGNIN);

        if (\Yii::$app->request->isPost) {

            if ($comp->loginUser($model)) {
                //$this->redirect(['/activity/create']);
                //$this->redirect(\Yii::$app->request->referrer);
                $this->goBack();

            }
        }

        return $this->render('signin', ['model' => $model]);

    }
}