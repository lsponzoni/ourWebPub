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
			        	'attribute' => 'nome' ,
			        	'label' => "Autor",
			        	'format' => 'html',
			        	'enableSorting' => 'true',
			        	'value' => function($data)
			        		{
			        			$url = Url::to(['perfil-autor', 'id' => $data->idPublicador]);
			        			
			        			return '<a href ='.$url.'>'.$data->nome.'</a>';
			        		}
			        	),
			        'email:text:Email',
			      
			      //['class' => 'yii\grid\ActionColumn'],
	        ],
	        
	        'emptyText' => 'Nenhuma publicação nova.',
	    ]);
	?>

</div><!-- site-convite -->
