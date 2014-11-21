<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Publicador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publicador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => 75]) ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'senha')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'endereco')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
