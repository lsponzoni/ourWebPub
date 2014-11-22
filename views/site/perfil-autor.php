<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\base\Model;
use yii\helpers\Url;
use yii\grid\DataColumn;
use yii\data\ArrayDataProvider;

?>
<head><style>
h1{
	padding: 15px;
}
.right{
  text-align: right !important;
  padding-right: 15px !important; 
}

.left{
  text-align: left !important; 
}

.bold{
  font-weight: bold !important;
}

.center{
  display: inline-block !important;
  text-align: center !important;
}
th{
	text-align: center !important;
}
td.right{
	font-size: 18px !important; 
}
td.left{
	font-size: 18px !important; 
}
</style></head>

<div class="site-convite">

<div class="jumbotron">
    <h1><?php echo $publicador["publicador"]->nome ?></h1>
    <div class="center">
	    <table>
	    	<tr>
	    		<td class="strong right bold">Nome do Publicador:</td>
	    		<td class="left"><?php echo $publicador["publicador"]->nome ?></td>
	    	</tr>
	    	<?php if (count($publicador["abreviaturas"]) > 0): ?>
		    	<tr>
		    		<td class="strong right bold">Nomes Científicos:</td>
		    		<td class="left"><?php  $string = implode(", ", $publicador["abreviaturas"]); echo($string); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    	<?php if (count($publicador["areas"]) > 0): ?>
		    	<tr>
		    		<td class="strong right bold">Áreas de Estudo:</td>
		    		<td class="left"><?php  $string = implode(", ", $publicador["areas"]); echo($string); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    	<?php if ($publicador["publicador"]->email != NULL): ?>
		    	<tr>
		    		<td class="strong right bold">E-mail:</td>
		    		<td class="left"><?php  echo($publicador["publicador"]->email); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    	<?php if (count($publicador["locais"]) > 0): ?>
		    	<tr>
		    		<td class="strong right bold">Locais de Trabalho:</td>
		    		<td class="left"><?php  $string = implode(", ", $publicador["locais"]); echo($string); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    	<?php if (count($publicador["grupos"]) > 0): ?>
		    	<tr>
		    		<td class="strong right bold">Grupos Associados:</td>
		    		<td class="left"><?php  $string = implode(", ", $publicador["grupos"]); echo($string); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    </table>
	</div>
</div>

<?php
	$publicacoesDataProvider=new ArrayDataProvider(array(
	    'allModels'=>$publicador["publicacoes"]["model"],
	    'sort'=>array(
	        'attributes'=>array(
	             'titulo', 'local', 'ano'
	        ),
	    ),
	    'pagination'=>array(
	        'pageSize'=>10,
	    ),
	));
?>

<div class="jumbotron">
    <div >
        <h2>Publicações de <?php echo $publicador["publicador"]->nome; ?></h2>

        <p>
         <?php
            echo GridView::widget([               
                'dataProvider' => $publicacoesDataProvider,
                'columns' => array( 
                	array(
				        	'attribute' => 'titulo',
				        	'label' => "Título",
				        	'format' => 'html',
				        	'enableSorting' => 'true',
				        	'value' => function($data)
				        		{
				        			$url = Url::to(['perfil-publicacao', 'id' => $data['idPublicacao']]);
				        			
				        			return '<a href ='.$url.'>'.$data['titulo'].'</a>';
				        		}
				        ), 
                	'local:text:Local', 
                	'ano:text:Ano'),
                'emptyText' => 'Esse publicador ainda não possui nenhuma publicação',
            ]);
        ?>
        </p>
    </div>
</div>

</div><!-- site-convite -->
