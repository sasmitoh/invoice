<?php
use yii\helpers\Html;
use yii\helpers\Url;

$view_element = 'payment_id'.$model->id;
//$view_element_td = 'td_payment_id'.$model->id;
?>

<tr id="<?php echo Html::encode($view_element); ?>">
    <td><?php echo Html::encode($model->id); ?></td>
    <td><?php echo Html::a($model->name, Url::toRoute(['payment/update','id'=>$model->id])); ?></td>
<!--    <td>
       <?php 
/*            $url = Url::toRoute(['payment/update','id'=>$model->id]);
            echo Html::a('save',Url::toRoute(['payment/update','id'=>$model->id]),
            [
             'title' => Yii::t('yii', 'Save'),
             'class' => 'btn btn-primary btn-xs',
             'onclick'=>"{  var name = $('#".$view_element_td." ').val();
               $.ajax({
               url  : '".$url."',
               type :'POST',
               data: {'name': name},
               success  : function(response) { $('#".$view_element_td."').empty().html(response).focus();   }
             })}; return false; ",
           ]);*/
       ?>
      &nbsp;
      <?php  
/*           echo Html::a('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',['delete', 'id'=>$model->id],
           [
             'title' => Yii::t('yii', 'Delete'),
             'onclick'=>"if(confirm('Вы действительно хотите удалить?'))"
            . "{ $('#".$view_element." ').dialog('open');//for jui dialog in my page
                $.ajax({
               type     :'POST',
               cache    : false,
               url  : 'payment/delete',
               success  : function(response) { $('#".$view_element."').html(response);   }
           })}; return false; ",
          ]);*/
      ?> 
   </td>-->
</tr>