<style>
    .is_hidden{display: none}
    .is_active{display: inline}
</style>
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
    <?php echo $form->labelEx($model, 'name', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->textField($model, 'name', array('class' => 'col-xs-10 col-sm-5', 'placeholder' => '')) ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'begin_date', array('class' => 'col-sm-3 control-label no-padding-right')) ?>
    <div class="row">
        <div class="col-sm-3">
            <div class="input-group input-group-sm">
                <input type="text" id="datepicker_begin" name="Project[begin_date]" class="form-control" />
                <span class="input-group-addon">
                    <i class="icon-calendar"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'end_date', array('class' => 'col-sm-3 control-label no-padding-right')) ?>
    <div class="row">
        <div class="col-sm-3">
            <div class="input-group input-group-sm">
                <input type="text" id="datepicker_end" name="Project[end_date]" class="form-control" />
                <span class="input-group-addon">
                    <i class="icon-calendar"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'goods_ids', array('class' => 'col-sm-3 control-label no-padding-right')) ?>
    <div class="col-sm-9">
        <?php if ($goods_category): ?>
            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th width='200'>商品分类</th>
                        <th>商品</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($goods_category as $k => $v): ?>
                        <tr>
                            <td><?php echo $v['html'] . $v['name']; ?></td>
                            <td>
                                <?php if (isset($goodsData[$v['id']])): ?>
                                    <?php foreach ($goodsData[$v['id']] as $key => $val): ?>
                                        <label class="pull-left place-checkbox">
                                            <input type="checkbox" <?php if (in_array($val['id'], $modelGoodsIds)): ?>checked='checked'<?php endif ?> class="ace" name='goods_ids[]' value='<?php echo $val['id'] ?>'>
                                            <span class="lbl"> <?php echo $val['name'] ?>&nbsp;&nbsp;</span>
                                        </label>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'depart_ids', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->checkBoxList($model, 'depart_ids', Depart::getDepart(), array('placeholder' => '', 'separator' => ' ')) ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'first', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <input type='text' name="First[]" style='width:60px'> : <input type='text' name="First[]" style='width:60px'>----<input type='text' name="First[]" style='width:60px'> : <input type='text' name="First[]" style='width:60px'>
    </div>
</div>
<div class="form-group">
    <label class='col-sm-3 control-label no-padding-right'></label>
    <input type='checkbox' name='is_second' class="is_second">添加第二次采价时间
</div>
<div class="form-group is_hidden second_caijia">
    <?php echo $form->labelEx($model, 'second', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <input type='text' name="Second[]" style='width:60px'> : <input type='text' name="Second[]" style='width:60px'>----<input type='text' name="Second[]" style='width:60px'> : <input type='text' name="Second[]" style='width:60px'>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'desc', array('class' => 'col-sm-3 control-label no-padding-right')) ?>
    <div class="col-sm-9">
        <script id="container" name="Project[desc]" type="text/plain" data-width="1200"><?php echo $model->desc; ?></script>
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
<script src="/ace/assets/js/jquery-ui-1.10.3.full.min.js"></script>
<link rel="stylesheet" href="/ace/assets/css/jquery-ui-1.10.3.full.min.css" />
<script type="text/javascript">
    jQuery(function ($) {
        $("#datepicker_begin").datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: 'yy-mm-dd',//日期格式  
        });
        $("#datepicker_end").datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            dateFormat: 'yy-mm-dd',//日期格式  
        });
    });
    $(function () {
        $('.is_second').on('click', function () {
            if ($('.second_caijia').hasClass('is_hidden')) {
                $('.second_caijia').removeClass('is_hidden').addClass('is_active');
            }else{
                $('.second_caijia').removeClass('is_active').addClass('is_hidden');
            }
        });
    })
</script>