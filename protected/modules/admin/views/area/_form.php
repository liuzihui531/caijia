<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'id-form',
    'action' => $this->createUrl('save'),
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    ),
        ));
?>
<?php if ($model->id): ?>
    <input type="hidden" name="id" value="<?php echo $model->id ?>" />
<?php endif; ?>
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="Area_pname">上级地区</label>
    <div class="col-sm-9">
        <input name="Area[pname]" id="Area_pname" type="text" value="<?php echo $pname ?>" disabled="disabled">
        <input name="pid" type="hidden" value="<?php echo Yii::app()->request->getParam("pid",0) ?>">    
        <input name="level"  type="hidden" value="<?php echo $level ?>">    
        <input name="fullname"  type="hidden" value="<?php echo $fullname ?>">    
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'areaname', array('class' => 'col-sm-3 control-label no-padding-right')) ?>
    <div class="col-sm-9">
        <?php echo $form->textField($model, 'areaname', array('class' => 'col-xs-10 col-sm-5', 'placeholder' => '')) ?>
    </div>
</div>
<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="button" id="submit">
            <i class="icon-ok bigger-110"></i>
            提交
        </button>

        &nbsp; &nbsp; &nbsp;
        <button class="btn" type="reset">
            <i class="icon-undo bigger-110"></i>
            重置
        </button>
    </div>
</div>
<?php $this->endWidget(); ?>