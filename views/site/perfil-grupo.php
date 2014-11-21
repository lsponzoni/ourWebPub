<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\base\Model;
use yii\helpers\Url;
use yii\grid\DataColumn;
use yii\data\ArrayDataProvider;

use app\models\Publicador;
use app\models\PublicaPeloGrupo;
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
    <h1><?php echo $grupo->nome ?></h1>
    <div class="center">
	    <table>
	    	<tr>
	    		<td class="strong right bold">Líder do Grupo:</td>
	    		<td class="left"><?php $url = Url::to(['perfil-autor', 'id' => $grupo->Lider]); echo '<a href = '.$url.' >'.Publicador::find()->where(array("idPublicador" => $grupo->Lider))->all()[0]->nome.'</a>' ?></td>
	    	</tr>
	    	<tr>
	    		<td class="strong right bold">Membros:</td>
	    		<td class="left"><?php echo count($membros); ?></td>
	    	</tr>
	    	<tr>
	    		<td class="strong right bold">Publicações:</td>
	    		<td class="left"><?php echo count($publicacoes); ?></td>
	    	</tr>
	    </table>
	</div>
</div>
	
	<?php
		$membrosDataProvider=new ArrayDataProvider(array(
		    'allModels'=>$membros,
		    'sort'=>array(
		        'attributes'=>array(
		             'id', 'email', 'nome'
		        ),
		    ),
		    'pagination'=>array(
		        'pageSize'=>10,
		    ),
		));
	?>
<div class="jumbotron">
    <div >
        <h2>Membros do Grupo</h2>

        <p>
         <?php
            echo GridView::widget([               
                'dataProvider' => $membrosDataProvider,
                'columns' => array( 
                	array(
				        	'attribute' => 'nome',
				        	'label' => "Nome",
				        	'format' => 'html',
				        	'enableSorting' => 'true',
				        	'value' => function($data)
				        		{
				        			$url = Url::to(['perfil-autor', 'id' => $data['idPublicador']]);
				        			
				        			return '<a href ='.$url.'>'.$data['nome'].'</a>';
				        		}
				        ),
                	'email:text:E-Mail'),
                'emptyText' => 'Nenhum membro',
            ]);
        ?>
        </p>
    </div>
</div>

	<?php
		$publicacoesDataProvider=new ArrayDataProvider(array(
		    'allModels'=>$publicacoes,
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
        <h2>Publicações do Grupo</h2>

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
                'emptyText' => 'Esse grupo ainda não possui nenhuma publicação',
            ]);
        ?>
        </p>
    </div>
</div>

</div><!-- site-convite -->
