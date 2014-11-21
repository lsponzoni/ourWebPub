<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\base\Model;
use yii\helpers\Url;

use app\models\Publicador;

?>

<div class="site-convite">

	<?php
		echo GridView::widget([               
	        'dataProvider' => $dataProvider,
	        // 'filterModel' => $model,

	        'columns' => array( 
	        	
	        	// ['class' => 'yii\grid\SerialColumn'],
			        array(
			        	'attribute' => 'nome' ,
			        	'label' => "Grupo",
			        	'format' => 'html',
			        	'enableSorting' => 'true',
			        	'value' => function($data)
			        		{
			        			$url = Url::to(['perfil-grupo', 'id' => $data->Grupo]);
			        			
			        			return '<a href ='.$url.'>'.$data->nome.'</a>';
			        		}
			        	),
			        array(
			        	'label' => "Dono",
			        	'format' => 'text',
			        	'enableSorting' => 'true',
			        	'value' => function($data)
			        		{
			        			return Publicador::find()->where(array("idPublicador"=> $data->Lider))->all()[0]->nome;
			        		}
			        	),
			        
			      
			      //['class' => 'yii\grid\ActionColumn'],
	        ),
	        
	        'emptyText' => 'Nenhuma publicação nova.',
	    ]);
	?>

</div><!-- site-convite -->
