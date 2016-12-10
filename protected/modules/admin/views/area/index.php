<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <!--搜索框开始-->
            <div class="widget-box">
                <div class="widget-header">
                    <h4>搜索框</h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <form class="form-inline" method="get">
                            <a href="<?php echo $this->createUrl('create', array('pid' => 0)) ?>" class="btn btn-primary btn-sm">添加城市</a>
                        </form>
                    </div>
                </div>
            </div>
            <!--搜索框结束-->
            <?php if ($model): ?>
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">ID</th>
                            <th>地区名称</th>
                            <th>地区码</th>
                            <th class="hidden-480">创建时间</th>

                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($model as $k => $v): ?>
                            <tr>
                                <td class="center">
                                    <!--<i class="icon-plus icon-button" data-id="<?php echo $v['id']; ?>"></i>-->
                                            <?php echo $v['id'] ?>
                                </td>
                                <td><?php echo $v['html'].$v['areaname'];?></td>
                                <td><?php echo $v['areacode'] ?></td>
                                <td><?php echo date('Y-m-d H:i:s', $v['created']) ?></td>
                                <td>
                                    <?php if ($v['level'] < 4): ?>
                                        <a href="<?php echo $this->createUrl('create', array('id' => $v['id'], 'pid' => $v['id'])) ?>">增加子类</a>
                                    <?php endif; ?>
                                    <a href="<?php echo $this->createUrl('update', array('id' => $v['id'], 'pid' => $v['pid'])) ?>">修改</a>
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
