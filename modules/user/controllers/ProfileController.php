<?php
namespace  app\modules\user\controllers;

use  app\modules\user\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\user\models\ProfileUpdateForm;
use Yii;

//namespace app\modules\user\controllers;
//
//use app\modules\user\models\User;
//use yii\filters\AccessControl;
//use yii\web\Controller;
//use Yii;
//
//class ProfileController extends Controller
//{
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//        ];
//    }
//
//    public function actionIndex()
//    {
//        return $this->render('index', [
//            'model' => $this->findModel(),
//        ]);
//    }
//
//    /**
//     * @return User the loaded model
//     */
//    private function findModel()
//    {
//        return User::findOne(Yii::$app->user->identity->getId());
//    }
//}
class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'model' => $this->findModel(),
        ]);
    }

    public function actionUpdate()
    {
        $user = $this->findModel();
        $model = new ProfileUpdateForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }



    /**
     * @return User the loaded model
     */
    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }
}
