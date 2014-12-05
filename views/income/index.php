<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this VatController */
/* @var $dataProvider CActiveDataProvider */

$this->title=Yii::$app->name . ' - Income';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?php echo Yii::t('lang', 'Incomes'); ?></h1>

<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>from</th>
        <th>to</th>
        <th>manager %</th>
        <th>admin %</th>
    </tr>
<?php echo ListView::widget([
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
]); ?>
</table>
