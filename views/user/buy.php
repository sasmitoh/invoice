<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\models\Setting;
use app\models\Credit_paket;


$this->title = Yii::$app->name . ' - ' . Yii::t('app', 'Buy credits');
$this->params['breadcrumbs'][] = $this->title;

?>

<h1 class="title"><?php  echo Yii::t('app', 'Buy credits');  ?></h1>
<div class="form">
<?php $form = ActiveForm::begin([
    'id'=>'invoice-form',
    'enableAjaxValidation'=>false,
    'options'=>['enctype'=>'multipart/form-data','class' => 'form-horizontal', 'role'=>'form'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-md-6\">{input}</div>\n<div class=\"col-md-offset-2 col-md-7\">{error}</div>",
    ],
]); ?>
<div class="row">
    <div class="fieldset-column pull-left">
        <?php
        $enabled_package = Credit_paket::isEnabled();
        if ($enabled_package) {
            echo $form->field($model, 'credit',['labelOptions'=>['class'=>'control-label col-md-5']])->dropDownList(Credit_paket::listPaket(), ['class'=>'form-control','id'=>'cost_id'])->hint('You credit ')->label('Cost (€):') ;
        } else {
            echo $form->field($model, 'credit',['labelOptions'=>['class'=>'control-label col-md-5']])->textInput(['id'=>'cost_id'])->hint('You credit ')->label('Cost (€):') ;
        }
        ?>
        <div class="form-group field-user_payment-credit required">
            <label class="control-label col-md-5" for="user_payment-credit">Number of Credits:</label>
            <div class="col-md-6">
                <?php echo Html::textInput('number_credits', $model->credit, ['class'=>'form-control', 'disabled' => 'disabled','id'=>'credit_id']); ?>
            </div>
        </div>
        <div class="form-group field-user_payment-credit required">
            <label class="control-label col-md-5" for="user_payment-credit">Payment:</label>
            <div class="col-md-6">
                <?php echo Html::dropDownList('payment_credits','',Setting::List_payment(),['prompt'=>'-Choose a Payment-','id'=>'payment_credits', 'class'=>'form-control dropdown-ajax']); ?>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('Buy Credits', ['class' => 'btn btn-action', 'name' => 'send']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    var active_payment = 0;
    var url_card = '<?= Url::toRoute(['/user/buy', 'id' => Yii::$app->user->id, 'payment_id' => 1], true) ?>';
    var url_paypal = '<?= Url::toRoute(['/user/payment_credit', 'id' => Yii::$app->user->id, 'payment_id' => 2], true) ?>';
    var url_bank = '<?= Url::toRoute(['/paymentbanktrans/create','payment_id' => 3], true) ?>';
    var cost = 0;
    $(document).ready(function() {

        $("#payment_credits").change(function() {
            var payment = $("#payment_credits").val();
            var final_cost = cost;
            if( payment == 2 ) final_cost = cost*(1+0.035);
            final_cost = final_cost.toFixed(2);
//            alert(final_cost);
            $("#final_id").val(final_cost);
        });
    })
</script>

<?php
Yii::$app->view->registerJsFile('@web/js/choose_payment.js');
?>
