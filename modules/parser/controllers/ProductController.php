<?php

namespace app\modules\parser\controllers;


use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\parser\models\Product;
use app\modules\parser\models\ProductSearch;
use app\modules\parser\models\Parse;
use app\modules\parser\models\RequestForm;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			 'verbs' => [
				  'class'   => VerbFilter::className(),
				  'actions' => [
						'delete' => ['POST'],
				  ],
			 ],
		];
	}
	
	/**
	 * Displays a single Product model.
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
	 * Creates a new Product model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Product();
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				 'model' => $model,
			]);
		}
	}
	
	/**
	 * Updates an existing Product model.
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
	 * Deletes an existing Product model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		
		return $this->redirect(['list']);
	}
	
	/**
	 * Finds the Product model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Product the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Product::findOne($id)) !== NULL) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	
	public function actionIndex()
	{
		$model = new RequestForm();
		
		if (Yii::$app->request->isPost && $model->validate()) {
			$model->load(Yii::$app->request->post());
			$request = $model->request;
			
			$parser = new Parse();
			$parser->setRequest($request);
			$parser->parse();
			
			return $this->redirect('list');
		}
		
		return $this->render('index', [
			 'model' => $model,
		]);
	}
	
	/**
	 * Lists all Product models.
	 * @return mixed
	 */
	public function actionList()
	{
		$model = Product::find()->indexBy('base_url')->one();
		($model) ? $base_url = $model->base_url : $base_url = 'пока нет результатов';
		
		$searchModel = new ProductSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		return $this->render('list', [
			 'searchModel'  => $searchModel,
			 'dataProvider' => $dataProvider,
			 'base_url'     => $base_url,
			 'model'        => $model
		]);
		
	}
	
	public function actionParse()
	{
		$model = new Parse();
		$model->parse();
		
		return $this->redirect('list');
	}
	
	public function actionDeleteAll()
	{
		Product::deleteAll();
		
		return $this->redirect('list');
	}
	
}