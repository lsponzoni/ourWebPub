<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Publicador */

$this->title = $model->idPublicador;
$this->params['breadcrumbs'][] = ['label' => 'Publicadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idPublicador], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idPublicador], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPublicador',
            'nome',
            'login',
            'senha',
            'endereco',
            'email:email',
            'convidadoPor',
        ],
    ]) ?>

</div>
