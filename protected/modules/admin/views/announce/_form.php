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
    <?php echo $form->labelEx($model, 'title', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->textField($model, 'title', array('class' => 'col-xs-10 col-sm-5', 'placeholder' => '')) ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'content', array('class' => 'col-sm-3 control-label no-padding-right')) ?>
    <div class="col-sm-9">
        <script id="container" name="Announce[content]" type="text/plain" data-width="1200"><?php echo $model->content; ?></script>
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