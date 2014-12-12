<?php

namespace app\controllers;

use Yii;
use app\models\Paymentbanktrans;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Request;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PaymentbanktransController implements the CRUD actions for Paymentbanktrans model.
 */
class PaymentbanktransController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Paymentbanktrans models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Paymentbanktrans::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
	    'creditPath' => Yii::$app->params['creditPath'],
        ]);
    }

    /**
     * Displays a single Paymentbanktrans model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Paymentbanktrans model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
	$model = new Paymentbanktrans();
	//$user = User::find()->where(['id' => Yii::$app->user->id])->one();

	if (Yii::$app->request->isPost) {
	    $model->attributes = $_POST['Paymentbanktrans'];

	    $file = UploadedFile::getInstance($model, 'file');

	    $model->file = $file->name;
	    $model->user_id = Yii::$app->user->id;

	    if ($model->validate() && $file) {
		$model->save();
		$file->saveAs(Yii::$app->params['creditPath'] . $file->name);
		//@todo send mail to superadmin
		//echo Yii::$app->user->identity->email; exit;
		Yii::$app->mailer->compose()
		    ->setFrom(Yii::$app->user->identity->email)
		    ->setTo('phpdev@xaker.ru')
		    ->setSubject('get credit')
		    ->setTextBody($model->message)
		    ->attach(Yii::$app->params['creditPath'] . $file->name)
		    ->send();
		Yii::$app->getSession()->setFlash('successCreditPay', 'Your message send to superadmin');
		$this->redirect(array('create', 'id' => $model->id));
	    }
	} else {
	    return $this->render('create', [
			'model' => $model,
	    ]);
	}
    }

    /**
     * Updates an existing Paymentbanktrans model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Paymentbanktrans model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Paymentbanktrans model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Paymentbanktrans the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paymentbanktrans::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
