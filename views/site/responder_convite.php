<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResponderConviteForm */
/* @var $form ActiveForm */
?>
<div class="site-responder_convite">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'token') ?>
        <?= $form->field($model, 'email') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-responder_convite -->
