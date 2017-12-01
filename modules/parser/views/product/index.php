<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h1>Главная страница парсера</h1>

<div class="col-md-6">
	
	<?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'request')->textInput(['maxlength' => true])->hint('Введите слово для парсинга')->label('Запрос: ') ?>

	<div class="form-group">
		<?= Html::submitButton('Парсить', ['class' => 'btn btn-primary']) ?>
	</div>
	
	<?php ActiveForm::end(); ?>
</div>
