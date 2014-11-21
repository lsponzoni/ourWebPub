<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\base\Model;

?>

<div class="site-convite">

	<?php
	    echo GridView::widget([               
	        'dataProvider' => $dataProvider,
	        'filterModel' => $model,

	        'columns' => [ 
	        	
	        	// ['class' => 'yii\grid\SerialColumn'],
			        'titulo:text:Publicação',
			        'ano:text:Ano',
			        'local:text:Local',
			      
			      //['class' => 'yii\grid\ActionColumn'],
	        ],
	        
	        'emptyText' => 'Nenhuma publicação nova.',
	    ]);
	?>

</div><!-- site-convite -->
