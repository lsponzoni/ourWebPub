<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';

use yii\grid\GridView;
use yii\widgets\ListView;


?>

<div class="site-index">

    <div class="jumbotron">
        <h1>Bem Vindo ao Site de Publicações!</h1>

        <p class="lead">Aqui você pode pesquisar por artigos, autores e grupos, postar suas próprias publicações e montar seu próprio perfil de pesquisa.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Comece Agora!</a></p>
    </div>

    <div class="body-content">

        <div class="jumbotron">
            <div >
                <h2>Publicações</h2>

                <p>
                 <?php
                    echo GridView::widget([               
                        'dataProvider' => $dataProviderPublicacao,
                        'columns' => [ 'titulo:text:Publicação'],
                        'emptyText' => 'Nenhuma publicação nova.',
                    ]);
                ?>
                </p>

                <p><a class="btn btn-default" href="/site/publicacoes">Pesquisar Publicações &raquo;</a></p>
            </div>
        </div>
        <div class="jumbotron">
            <div>
                <h2>Autores</h2>

                <p>
                 <?php
                    echo GridView::widget([               
                        'dataProvider' => $dataProviderAutor,
                        'columns' => [ 'nome:text:Autor'],
                        'emptyText' => 'Nenhum autor novo.',
                    ]);
                ?>
                </p>

                <p><a class="btn btn-default" href="/site/autores">Pesquisar Autores &raquo;</a></p>
            </div>
        </div>
        <div class="jumbotron">
            <div >
                <h2>Grupos</h2>

                <p>
                 <?php
                    echo GridView::widget([               
                        'dataProvider' => $dataProviderGrupo,
                        'columns' => [ 'nome:text:Grupo'],
                        'emptyText' => 'Nenhum grupo novo.',
                    ]);
                ?>
                </p>

                <p><a class="btn btn-default" href="/site/grupos">Pesquisar Grupos &raquo;</a></p>
            </div>
        </div>
    </div>
    </div>
</div>
