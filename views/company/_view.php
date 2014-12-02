<?php
use yii\helpers\Html;
/* @var $this CompanyController */
/* @var $model Company */
?>


<div class="view">

    <b><?php echo Html::encode($model->getAttributeLabel('id')); ?>:</b>
    <?php echo Html::a(Html::encode($model->id), array('view', 'id'=>$model->id)); ?>
    <br />

    <b><?php echo Html::encode($model->getAttributeLabel('name')); ?>:</b>
    <?php echo Html::encode($model->name); ?>
    <br />

    <b><?php echo Html::encode($model->getAttributeLabel('logo')); ?>:</b>
      <?php echo Html::img(Yii::$app->params['imagePath'].$model->logo,['alt'=>'company']); ?>
    <br />

    <b><?php echo Html::encode($model->getAttributeLabel('country')); ?>:</b>
    <?php echo Html::encode($model->country); ?>
    <br />

    <b><?php echo Html::encode($model->getAttributeLabel('city')); ?>:</b>
    <?php echo Html::encode($model->city); ?>
    <br />

    <b><?php echo Html::encode($model->getAttributeLabel('street')); ?>:</b>
    <?php echo Html::encode($model->street); ?>
    <br />

    <b><?php echo Html::encode($model->getAttributeLabel('post_index')); ?>:</b>
    <?php echo Html::encode($model->post_index); ?>
    <br />

   
    <b><?php echo Html::encode($model->getAttributeLabel('phone')); ?>:</b>
    <?php echo Html::encode($model->phone); ?>
    <br />

    <b><?php echo Html::encode($model->getAttributeLabel('web_site')); ?>:</b>
    <?php echo Html::encode($model->web_site); ?>
    <br />

    <b><?php echo Html::encode($model->getAttributeLabel('mail')); ?>:</b>
    <?php echo Html::encode($model->mail); ?>
    <br />

    <b><?php echo Html::encode($model->getAttributeLabel('vat_number')); ?>:</b>
    <?php echo Html::encode($model->vat_number); ?>
    <br />

    <b><?php echo Html::encode($model->getAttributeLabel('activity')); ?>:</b>
    <?php echo Html::encode($model->activity); ?>
    <br />

    <b><?php echo Html::encode($model->getAttributeLabel('resp_person')); ?>:</b>
    <?php echo Html::encode($model->resp_person); ?>
    <br />
</div>