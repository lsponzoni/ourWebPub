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
    <h1><?php echo $publicacao["publicacao"]->titulo ?></h1>
    <div class="center">
	    <table>
	    	<tr>
	    		<td class="strong right bold">Título:</td>
	    		<td class="left"><?php echo $publicacao["publicacao"]->titulo ?></td>
	    	</tr>
	    	<?php if (count($publicacao["areas"]) > 0): ?>
		    	<tr>
		    		<td class="strong right bold">Áreas de Pesquisa:</td>
		    		<td class="left"><?php  $string = implode(", ", $publicacao["areas"]); echo($string); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    	<?php if (count($publicacao["publicadores"]) > 0): ?>
		    	<tr>
		    		<td class="strong right bold">Publicadores:</td>
		    		<td class="left"><?php  $string = implode(", ", $publicacao["publicadores"]); echo($string); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    	<?php if ($publicacao["publicacao"]->tipo != NULL): ?>
		    	<tr>
		    		<td class="strong right bold">Tipo:</td>
		    		<td class="left"><?php  echo($publicacao["publicacao"]->tipo); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    	<?php if ($publicacao["publicacao"]->ano != NULL): ?>
		    	<tr>
		    		<td class="strong right bold">Ano:</td>
		    		<td class="left"><?php  echo($publicacao["publicacao"]->ano); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    	<?php if (count($publicacao["referencias"]) > 0): ?>
		    	<tr>
		    		<td class="strong right bold">Referências:</td>
		    		<td class="left"><?php  $string = implode(", ", $publicacao["referencias"]); echo($string); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    	<?php if (count($publicacao["grupos"]) > 0): ?>
		    	<tr>
		    		<td class="strong right bold">Grupos Associados:</td>
		    		<td class="left"><?php  $string = implode(", ", $publicacao["grupos"]); echo($string); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    	<?php if ($publicacao["publicacao"]->local != NULL): ?>
		    	<tr>
		    		<td class="strong right bold">Local:</td>
		    		<td class="left"><?php  echo($publicacao["publicacao"]->local); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    	<?php if ($publicacao["publicacao"]->PagInicial != NULL && $publicacao["publicacao"]->PagFinal != NULL): ?>
		    	<tr>
		    		<td class="strong right bold">Pgs:</td>
		    		<td class="left"><?php  echo($publicacao["publicacao"]->PagInicial.'-'.$publicacao["publicacao"]->PagFinal); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    	<?php if ($publicacao["publicacao"]->link != NULL): ?>
		    	<tr>
		    		<td class="strong right bold">Link:</td>
		    		<td class="left"><?php  echo('<a href='.$publicacao["publicacao"]->link.'>'.$publicacao["publicacao"]->link.'</a>'); ?></td>
		    	</tr>
	    	<?php endif; ?>
	    </table>
	</div>
</div><!-- site-convite -->
