<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';

use yii\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\Url;

?>

<div class="site-index">

    <div class="jumbotron">
        <h2>Bem Vindo ao Site de Publicações!</h2>

        <p class="lead">Aqui você pode pesquisar por artigos, autores e grupos, postar suas próprias publicações e montar seu próprio perfil de pesquisa.</p>
    </div>

    <div >

        <div class="jumbotron">
            <div >
                <h2>Publicações</h2>

                <p>
                 <?php
                    echo GridView::widget([               
                        'dataProvider' => $dataProviderPublicacao,
                        'columns' => [ array(
                        'attribute' => 'titulo' ,
                        'label' => "Título",
                        'format' => 'html',
                        'enableSorting' => 'true',
                        'value' => function($data)
                            {
                                $url = Url::to(['perfil-publicacao', 'id' => $data->idPublicacao]);
                                
                                return '<a href ='.$url.'>'.$data->titulo.'</a>';
                            }
                        ),],
                        'emptyText' => 'Nenhuma publicação nova.',
                    ]);
                ?>
                </p>

                <p><a class="btn btn-info" href="<?=Url::to(['site/publicacoes'])?>">Pesquisar Publicações &raquo;</a></p>
            </div>
        </div>
        <div class="jumbotron">
            <div>
                <h2>Autores</h2>

                <p>
                 <?php
                    echo GridView::widget([               
                        'dataProvider' => $dataProviderAutor,
                        'columns' => [ array(
                        'attribute' => 'nome' ,
                        'label' => "Autor",
                        'format' => 'html',
                        'enableSorting' => 'true',
                        'value' => function($data)
                            {
                                $url = Url::to(['perfil-autor', 'id' => $data->idPublicador]);
                                
                                return '<a href ='.$url.'>'.$data->nome.'</a>';
                            }
                        ),],
                        'emptyText' => 'Nenhum autor novo.',
                    ]);
                ?>
                </p>

                <p><a class="btn btn-info" href="<?=Url::to(['site/autores'])?>">Pesquisar Autores &raquo;</a></p>
            </div>
        </div>
        <div class="jumbotron">
            <div >
                <h2>Grupos</h2>

                <p>
                 <?php
                    echo GridView::widget([               
                        'dataProvider' => $dataProviderGrupo,
                        'columns' => [ array(
                        'attribute' => 'nome' ,
                        'label' => "Grupo",
                        'format' => 'html',
                        'enableSorting' => 'true',
                        'value' => function($data)
                            {
                                $url = Url::to(['perfil-grupo', 'id' => $data->Grupo]);
                                
                                return '<a href ='.$url.'>'.$data->nome.'</a>';
                            }
                        ),],
                        'emptyText' => 'Nenhum grupo novo.',
                    ]);
                ?>
                </p>

                <p><a class="btn btn-info" href="<?=Url::to(['site/grupos'])?>">Pesquisar Grupos &raquo;</a></p>
            </div>
        </div>
    </div>
    </div>
</div>
