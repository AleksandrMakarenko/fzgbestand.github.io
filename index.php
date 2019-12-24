<?php

use app\models\FzgBestand;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FzgBestandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fzg Bestands';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php  echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="openLinks hidden">
    <?= Html::a('Go to Fahrzeug(Vechicle)', '/web/fahrzeug-vehicle/index', ['class' => 'linkToAnotherTable']) ?>
    <?= Html::a('Go to Einkauf(Purchase)', '/web/einkauf-purchase', ['class' => 'linkToAnotherTable']) ?>
    <?= Html::a('Go to FzgBestand', '/web/fzg-bestand/', ['class' => 'linkToAnotherTable']) ?>
    <?= Html::a('Go to Kaeufer(Customer)', '/web/kaeufer-customer/', ['class' => 'linkToAnotherTable']) ?>
    <?= Html::a('Go to Kaution', '/web/kaution', ['class' => 'linkToAnotherTable']) ?>
    <?= Html::a('Go to Mitarbeiter(Employee)', '/web/mitarbeiter-employee', ['class' => 'linkToAnotherTable']) ?>
    <?= Html::a('Go to Reparatur(Repair)', '/web/reparatur-repair', ['class' => 'linkToAnotherTable']) ?>
    <?= Html::a('Go to Verkaeufer(Vendor)', '/web/verkaeufer-vendor', ['class' => 'linkToAnotherTable']) ?>
    <?= Html::a('Go to Verkauf(Sale)', '/web/verkauf-sale', ['class' => 'linkToAnotherTable']) ?>

</div>
<div class="fzg-bestand-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Open Filter', null, ['class' => 'btn btn-success', 'onclick'=>'openFilter()']) ?>

        <?= Html::a('Create Fzg Bestand', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Open Go to ', null, ['class' => 'btn btn-success', 'onclick'=>'openLinks()']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
         //   ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nr',
            'ek_datum',
            'modell:ntext',
            'verkaeufer:ntext',
            'fin',
            'ek_netto_preis',
            'ek_mwst',
            'ek_brutto_preis',
            //'vk_status',
            [
                'label' => 'Vk Status',
                'value' => function ($model) {
                    return FzgBestand::$vk_status[$model->vk_status];
                }
            ],
            'vk_datum',
            'kaeufer:ntext',
            'vk_netto_preis',
            'vk_mwst',
            'vk_brutto_preis',
            'gewinn',
            'mitarbeiter_employee',
            'sonstiges:ntext',

           // ['class' => 'yii\grid\ActionColumn'],
            /*['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 8.7%'],
                //'visible'=> Yii::$app->user->isGuest ? false : true,
                'buttons'=>[
                    'view'=>function ($url, $model) {
                        $t = 'view?id='.$model->id;
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            Url::to($t),[ 'class' => 'btn btn-default btn-xs custom_button']);
                    },
                    'update'=>function ($url, $model) {
                        $t = 'fzg-bestand/update/'.$model->id;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>',
                            ['value'=>Url::to($t), 'class' => 'btn btn-default btn-xs custom_button']);
                    },
                    'delete'=>function ($url, $model) {
                        $t = 'fzg-bestand/delete/'.$model->id;
                        return Html::button('<span class="glyphicon glyphicon-trash"></span>',
                            ['value'=>Url::to($t), 'class' => 'btn btn-default btn-xs custom_button']);

                    },
                ],
            ],*/
        ],
    ]); ?>
    <style>
        .grid-view th {
            white-space: pre-wrap;
        }
    </style>

</div>
