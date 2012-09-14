<?php
/**
 * 自定义运费model
 * @author yuansir
 * 2012-3-29
 */
class ModelShippingMy extends Model {

    function getQuote($address) {
        $this->load->language('shipping/my');

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id='" . (int) $this->config->get('my_geo_zone_id') . "' AND country_id='" . (int) $address['country_id'] . "' AND (zone_id = '" . (int) $address['zone_id'] . "' OR zone_id = '0')");

        if (!$this->config->get('citylink_geo_zone_id')) {
            $status = true;
        } elseif ($query->num_rows) {
            $status = true;
        } else {
            $status = false;
        }

        $method_data = $quote_data = $cart = $cart_products = $special_zone_ids = array();

        $in_pecial_zone = FALSE;
        //特殊区域的ID
        $special_zone_ids = $this->db->query("SELECT zone_id FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = " . $this->config->get('my_special_geo_zone_id'));

        foreach ($special_zone_ids->rows as $key) {
            if ((int) $address['zone_id'] == (int) $key['zone_id']) {
                $in_pecial_zone = TRUE;
                break;
            }
        }

        $data = $special_catetory_products = $special_category = $cart_products = $temp_array = array();
        $special_category_pro_count = $filter_category_id = 0;

        //获取购物车中商品的ID
        $cart_products = $this->cart->getProducts();
        foreach ($cart_products as $key => $value) {
            $temp_array[$value['product_id']] = $value['product_id'];
        }
        $cart_products = array_keys($temp_array);

        if ($this->config->get('my_special_id')) {

            $special_category = explode(',', $this->config->get('my_special_id'));

            $this->load->model('catalog/product');

            foreach ($special_category as $filter_category_id) {
                $data['filter_category_id'] = $filter_category_id;
                //获取购物车中特殊类别商品的数量
                $special_catetory_products = array_keys($this->model_catalog_product->getProducts($data));

                if (count(array_intersect($cart_products, $special_catetory_products))) {
                    $special_category_pro_count = 1;
                    break;
                }
            }
        }

        $this->load->model('total/total');
        $cost = 0;
        //正常购买商品的运费 = 通用单个商品运费价格+额外数量增加的价格*（购买商品数量-1）
        $cost = $this->config->get('my_common') + $this->config->get('my_single_add') * ($this->cart->countProducts() - 1);

        if ($in_pecial_zone == TRUE) {
            //如果在运输地点在特殊区域内
            //总运费 = 正常购买商品的运费+特殊区域额外运费
            $cost += (int) $this->config->get('my_special_zone_price');
        }

        if ($special_category_pro_count > 0) {
            //如果购买的商品中有特殊列别下的商品
            //总运费 = 总运费+特殊类别商品额外金额
            $cost += (int) $this->config->get('my_special_single_price');
        }

        if ($this->cart->getSubTotal() >= $this->config->get('my_free')) {
            //如果总价大于等于免运费额度，则免费
            $cost = 0;
        }

        if ($status) {
            $quote_data['my'] = array(
                'code' => 'my.my',
                'title' => $this->language->get('text_description'),
                'cost' => $cost,
                'tax_class_id' => 0,
                'text' => $this->currency->format($cost)
            );
        }

        $method_data = array(
            'code' => 'my',
            'title' => $this->language->get('text_title'),
            'quote' => $quote_data,
            'sort_order' => $this->config->get('my_sort_order'),
            'error' => false
        );

        return $method_data;
    }

}
