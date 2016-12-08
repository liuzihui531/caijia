<style type="text/css">
    .place-checkbox{margin-right: 10px}
</style>
<form method='post'>
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <!--搜索框结束-->
                <?php if ($unlimit): ?>
                    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width='300'>地区名称</th>
                                <th>采价点</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($unlimit as $k => $v): ?>
                                <tr>
                                    <td><?php echo str_repeat( '---',$v['level']).$v['areaname'];?></td>
                                    <td>
                                        <?php if (isset($placeData[$v['areacode']])): ?>
                                            <?php foreach ($placeData[$v['areacode']] as $key => $val): ?>
                                                <label class="pull-left place-checkbox">
                                                    <input <?php if (in_array($val['id'], $modelPlaces)): ?>checked='checked'<?php endif ?> type="checkbox" class="ace" name='place_ids[]' value='<?php echo $val['id'] ?>'>
                                                    <span class="lbl"> <?php echo $val['name'] ?></span>
                                                </label>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </td>
                                </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php else: ?>
                    <div class="no-record">
                        暂无数据
                    </div>
                <?php endif; ?>
            </div><!-- /.table-responsive -->
        </div><!-- /span -->
    </div><!-- /row -->
    <div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="submit" id="submit">
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
<input type='hidden' name='id' value='<?php echo Yii::app()->request->getParam("id",0) ?>'>
</form>
