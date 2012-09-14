<?php

/**
 * 自定义的物流计算模块
 * @author yuansir
 * 2012-3-29
 */
class ControllerShippingMy extends Controller {

    private $error = array();

    function index() {
        $this->load->language('shipping/my');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $this->model_setting_setting->editSetting('my', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['heading_title'] = $this->language->get('heading_title');


        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['tab_general'] = $this->language->get('tab_general');

        $this->data['heading_title'] = $this->language->get('heading_title');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_shipping'),
            'href' => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('shipping/my', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('shipping/my', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['my_common'])) {
            $this->data['my_common'] = $this->request->post['my_common'];
        } else {
            $this->data['my_common'] = $this->config->get('my_common');
        }

        if (isset($this->request->post['my_free'])) {
            $this->data['my_free'] = $this->request->post['my_free'];
        } else {
            $this->data['my_free'] = $this->config->get('my_free');
        }

        if (isset($this->request->post['my_single_add'])) {
            $this->data['my_single_add'] = $this->request->post['my_single_add'];
        } else {
            $this->data['my_single_add'] = $this->config->get('my_single_add');
        }

        if (isset($this->request->post['my_special_id'])) {
            $this->data['my_special_id'] = $this->request->post['my_special_id'];
        } else {
            $this->data['my_special_id'] = $this->config->get('my_special_id');
        }
        
        if (isset($this->request->post['my_special_single_price'])) {
            $this->data['my_special_single_price'] = $this->request->post['my_special_single_price'];
        } else {
            $this->data['my_special_single_price'] = $this->config->get('my_special_single_price');
        }
        
        if (isset($this->request->post['my_special_zone_price'])) {
            $this->data['my_special_zone_price'] = $this->request->post['my_special_zone_price'];
        } else {
            $this->data['my_special_zone_price'] = $this->config->get('my_special_zone_price');
        }

        if (isset($this->request->post['my_special_geo_zone_id'])) {
            $this->data['my_special_geo_zone_id'] = $this->request->post['my_special_geo_zone_id'];
        } else {
            $this->data['my_special_geo_zone_id'] = $this->config->get('my_special_geo_zone_id');
        }

        if (isset($this->request->post['my_geo_zone_id'])) {
            $this->data['my_geo_zone_id'] = $this->request->post['my_geo_zone_id'];
        } else {
            $this->data['my_geo_zone_id'] = $this->config->get('my_geo_zone_id');
        }

        if (isset($this->request->post['my_status'])) {
            $this->data['my_status'] = $this->request->post['my_status'];
        } else {
            $this->data['my_status'] = $this->config->get('my_status');
        }

        if (isset($this->request->post['my_sort_order'])) {
            $this->data['my_sort_order'] = $this->request->post['my_sort_order'];
        } else {
            $this->data['my_sort_order'] = $this->config->get('my_sort_order');
        }



        $this->load->model('localisation/geo_zone');
        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        $this->template = 'shipping/my.tpl';

        $this->children = array(
            'common/header',
            'common/footer',
        );

        $this->response->setOutput($this->render());
    }

}
