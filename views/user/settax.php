<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this ServiceController */
/* @var $dataProvider CActiveDataProvider */

$this->title=Yii::$app->name . ' - Set Tax';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1 class="title"><?php echo Yii::t('app', 'Tax'); ?></h1>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>SurTax</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
<?php echo ListView::widget([
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_settax',
]); ?>
    </tbody>
</table>

