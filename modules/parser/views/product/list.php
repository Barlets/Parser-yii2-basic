<?php

use yii\grid\GridView;
use yii\helpers\Html;

?>

<h3>Результаты парсинга: <?= Html::tag('span', $base_url) ?></h3>

<?php if ($model !== NULL) : ?>
	<p><?= Html::a('Удалить все результаты парсинга', ['product/delete-all']) ?></p>
<?php endif ?>

<?= GridView::widget([
	 'dataProvider' => $dataProvider,
	 'filterModel'  => $searchModel,
	 'columns'      => [
		  ['class' => 'yii\grid\SerialColumn'],
		  'id',
		  'name',
		  [
				'attribute' => 'link',
				'format'    => 'raw',
				'value'     => function ($data) {
					return Html::a('Посмотреть на сайте', "$data->link");
				}
		  ],
		  'price',
		  [
				'attribute' => 'img',
				'format'    => 'raw',
				'value'     => function ($data) {
					return Html::img($data->img, ['width' => 100]);
				},
		  ],
		  
		  ['class' => 'yii\grid\ActionColumn'],
	 ],
]); ?>
