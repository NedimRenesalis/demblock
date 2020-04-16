<?php

namespace backend\controllers;

use common\models\Advert;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use backend\models\ChangePasswordForm;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['prijava', 'error', 'change-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $month = date('m');
        $year = date('Y');
        $data = null;
        $registeredEmployers = 0;
        $registeredEmployees = 0;
        $adverts = 0;
        $money['bam'] = 0;
        $money['eur'] = 0;

        if (Yii::$app->request->get()) {
            if (Yii::$app->request->get('month')) {
                $month = Yii::$app->request->get('month');
            }
        }

        if (Yii::$app->request->get()) {
            if (Yii::$app->request->get('year')) {
                $year = Yii::$app->request->get('year');
                if($year < 100){
                    $year += 2000;
                }
            }
        }

        $start_date = "01-" . $month . "-" . $year;
        $start_time = strtotime($start_date);

        $end_time = strtotime("+1 month", $start_time);

        for ($i = $start_time; $i < $end_time; $i += 86400) {
            $moneyTemp['bam'] = 0;
            $moneyTemp['eur'] = 0;
            $day = date('Y-m-d', $i);
            $list[] = $day;
            $start_timestamp = strtotime($day);
            $end_timestamp = $start_timestamp + 86400;


            $registeredEmployersTemp = User::find()
                ->where(['between','created_at', $start_timestamp, $end_timestamp])
                ->andWhere(['=','user_type', 2])
                ->count();
            $registeredEmployeesTemp = User::find()
                ->where(['between','created_at', $start_timestamp, $end_timestamp])
                ->andWhere(['=','user_type', 3])
                ->count();
            $advertsTemp = Advert::find()->where(['between','created_at', $start_timestamp, $end_timestamp])->count();

            $allAdvertBam = Advert::find()
                             ->leftJoin('user','advert.user_id=user.id')
                            ->where(['between','advert.created_at', $start_timestamp, $end_timestamp])
                            ->andWhere(['LIKE','user.language', 'BA'])
                            ->all();

            $allAdvertEur = Advert::find()
                ->where(['between','advert.created_at', $start_timestamp, $end_timestamp])
                ->leftJoin('user','advert.user_id=user.id')
                ->andWhere(['NOT LIKE','user.language', 'BA'])
                ->all();

            foreach ($allAdvertBam as $aBam){
                $moneyTemp['bam'] += $aBam['price'];
            }

            foreach ($allAdvertEur as $aBam){
                $moneyTemp['eur'] += $aBam['price'];
            }


            $registeredEmployers += $registeredEmployersTemp;
            $registeredEmployees += $registeredEmployeesTemp;
            $adverts += $advertsTemp;
            $money['bam'] += $moneyTemp['bam'];
            $money['eur'] += $moneyTemp['eur'];

            $d['date'] = $day;
            $d['employers'] = $registeredEmployersTemp;
            $d['employees'] = $registeredEmployeesTemp;
            $d['adverts'] = $advertsTemp;
            $d['money']['bam'] = $moneyTemp['bam'];
            $d['money']['eur'] = $moneyTemp['eur'];

            $data[] = $d;

        }

        return $this->render('index', [
            'month' => $month,
            'year' => $year,
            'data' => $data,
            'registeredEmployers' => $registeredEmployers,
            'registeredEmployees' => $registeredEmployers,
            'adverts' => $adverts,
            'moneyBam' => $money['bam'],
            'moneyEur' => $money['eur']
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionPrijava()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (User::getUserTypeByUsername(Yii::$app->user->identity->username) == 1) {
                return $this->goBack();
            } else {
                Yii::$app->user->logout(true);
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();
        $user = User::find()->where(["username" => Yii::$app->user->identity->username])->one();
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->getSecurity()->validatePassword($model->oldPassword, $user->password_hash)) {
                $hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                $user->password_hash = $hash;
                $user->save();
                \Yii::$app->getSession()->setFlash('success', 'Password has been changed.');
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Invalid current password!');
            }

        }

        return $this->render('change-password', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        return $this->redirect(['prijava']);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
