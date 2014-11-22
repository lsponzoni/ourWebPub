<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\base\Model;
use yii\helpers\Url;

?>

<div class="site-convite">

	<?php
	    echo GridView::widget([               
	        'dataProvider' => $dataProvider,
	        'filterModel' => $model,

	        'columns' => [ 
	        	
	        	// ['class' => 'yii\grid\SerialColumn'],
			        array(
			        	'attribute' => 'titulo' ,
			        	'label' => "Título",
			        	'format' => 'html',
			        	'enableSorting' => 'true',
			        	'value' => function($data)
			        		{
			        			$url = Url::to(['perfil-publicacao', 'id' => $data->idPublicacao]);
			        			
			        			return '<a href ='.$url.'>'.$data->titulo.'</a>';
			        		}
			        	),
			        'ano:text:Ano',
			        'local:text:Local',
			      
			      //['class' => 'yii\grid\ActionColumn'],
	        ],
	        
	        'emptyText' => 'Nenhuma publicação nova.',
	    ]);
	?>

</div><!-- site-convite -->
