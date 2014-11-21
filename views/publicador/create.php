<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Publicador */

$this->title = 'Create Publicador';
$this->params['breadcrumbs'][] = ['label' => 'Publicadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
