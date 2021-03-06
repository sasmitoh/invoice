<?php
use yii\grid\GridView;
use app\models\Country;
use app\models\Lang;

?>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [

        'id',
        'name',
        'email',
        [
            'attribute' => 'def_lang_id',
            'format' => 'html',
            'value' => function ($data) {
                /** @var app\models\Client $data */
                return $data->getLanguage()->asArray()->one()['name'];
            }

        ], [
            'attribute' => 'country_id',
            'format' => 'html',
            'value' => function ($data) {
                /** @var app\models\Client $data */
                    $cid = $data->getCountry()->asArray()->one()['cid'];
                    return Country::find()->where(['lang_id'=>Lang::$current->id, 'cid'=>$cid])->orderBy('cid')->asArray()->one()['name'];
//                return $data->getCountry()->asArray()->one()['name'];
            }

        ],
        'city',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons'=>[
                'delete'=>function($url, $model, $key){
                    return "<a href='#' data-id='$key' onclick='return false;' data-rmu='$url' class='rm-btn' data-message='Are you sure delete $model->name'><span class='glyphicon glyphicon-trash'></span></a>";
                }
            ]
        ],
    ],
]);

?>
