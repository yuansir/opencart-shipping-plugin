<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img alt="" src="view/image/shipping.png"><?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
        </div>
        <div class="content">
            <form id="form" enctype="multipart/form-data" method="post" action="<?php echo $action; ?>">
                <table class="form">
                    <tbody>
                        <tr>
                            <td>通用运费:<br><span class="help">正常商品购买一件的运费</span></td>
                            <td><input type="text" value="<?php echo $my_common; ?>" name="my_common"></td>
                        </tr>
                        <tr>
                            <td>全免:<br><span class="help">全免运费的购买额度，超过此额度则运费全免</span></td>
                            <td><input type="text" value="<?php echo $my_free; ?>" name="my_free"></td>
                        </tr>
                        <tr>
                            <td>单件增加价格:<br><span class="help">每多买一件增加的物流费,例如：+500</span></td>
                            <td><input type="text" value="<?php echo $my_single_add; ?>" name="my_single_add"></td>
                        </tr>
                        <tr>
                            <td>特殊品类ID:<br><span class="help">填入特殊商品类别ID,多个用英文半角逗号隔开</span></td>
                            <td><input type="text" value="<?php echo $my_special_id; ?>" name="my_special_id"></td>
                        </tr>
                         <tr>
                            <td>特殊品类额外运费:<br><span class="help">特殊商品类别运费相对于通用运费额外增加的运费例如：+500或者-500</span></td>
                            <td><input type="text" value="<?php echo $my_special_single_price; ?>" name="my_special_single_price"></td>
                        </tr>
                        <tr>
                            <td>特殊地区:<br><span class="help">选择适用于特的地区</span></td>
                            <td><select name="my_special_geo_zone_id">
                                    <option value="0">所有区域</option>
                                    <?php foreach ($geo_zones as $geo_zone) { ?>
                                    <?php if ($geo_zone['geo_zone_id'] == $my_special_geo_zone_id) { ?>
                                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>特殊地区单件增加运费:<br><span class="help">特殊地区单件相对于通用运费额外增加的运费，例如：+500或-500</span></td>
                            <td><input type="text" value="<?php echo $my_special_zone_price; ?>" name="my_special_zone_price"></td>
                        </tr>
                        <tr>
                            <td>适用地区</td>
                            <td><select name="my_geo_zone_id">
                                    <option value="0">所有区域</option>
                                    <?php foreach ($geo_zones as $geo_zone) { ?>
                                    <?php if ($geo_zone['geo_zone_id'] == $my_geo_zone_id) { ?>
                                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td>状态(Status):</td>
                            <td><select name="my_status">
                                    <?php if ($my_status) { ?>
                                    <option value="1" selected="selected">启用</option>
                                    <option value="0">停用</option>
                                    <?php } else { ?>
                                    <option value="1">启用</option>
                                    <option value="0" selected="selected">停用</option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>排序(Sort Order):</td>
                            <td><input type="text" size="1" value="<?php echo $my_sort_order; ?>" name="my_sort_order"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<?php echo $footer; ?> 