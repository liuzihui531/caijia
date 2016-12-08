<style type="text/css">
	/*.area-table ul li{float: left;list-style: none;}*/
	/*.area-table ul li.city{float: none}*/
	/*.clearfix:after{clear: both;width:0px;height:0px;}*/
	.area-li{float: left}
</style>
<div class="area-table">
<!-- 	<ul class='area-header'>
		<li>市</li>
		<li>县</li>
		<li>镇</li>
		<li>村</li>
	</ul> -->

<?php if ($subUnlimit): ?>
	<?php foreach ($subUnlimit as $key => $val): ?>
		<div class = "city clearfix">
			<div class=""><?php echo $val['areaname'] ?></div><!--市-->
				<div class="">
					<?php if ($val['sub']): ?>
						<?php foreach ($val['sub'] as $k => $v): ?>
							<div class="area-li"><?php echo $v['areaname'] ?></div><!--县-->
								<div class="clearfix">
									<?php if ($v['sub']): ?>
										<?php foreach ($v['sub'] as $kk => $vv): ?>
											<div class="area-li"><?php echo $vv['areaname'] ?></div><!--镇-->
												<div>
													<?php if ($vv['sub']): ?>
														<?php foreach ($vv['sub'] as $kkk => $vvv): ?>
															<div class="area-li"><?php echo $vvv['areaname'] ?></div><!--村-->
														<?php endforeach ?>
													<?php endif ?>
												</div>
										<?php endforeach ?>
									<?php endif ?>
								</div>
						<?php endforeach ?>
					<?php endif ?>
				</div>
		</div>
	<?php endforeach ?>
<?php endif ?>

</div>	