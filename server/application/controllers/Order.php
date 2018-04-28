<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK\Constants as Constants;


class Order extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->model('Order_model','order_model');
    }

    public function index()
    {
        $pageIndex = $this->input->get('per_page');
       $per_page= $this->config->item('per_page');
        $result= $this->order_model->pages($per_page,$pageIndex);

        $data['result'] = $result;
        $data['title'] = '订单列表';
        // 分页控件
        // url路径前缀
        $config['base_url'] = base_url(uri_string());
        $total_rows= $this->order_model->totalCount( );
        // 总条数
        $config['total_rows'] = $total_rows;
        // 初始化
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->layout->view('order/index', $data);

    }

    // 改变订单状态
    public function deal() {
        $objectId = $this->input->get('objectId');
        $status = $this->input->get('status');
        $bool= $this->order_model->changeStatus($objectId, (int)$status);

        $data['msg'] = '操作成功';
        $data['level'] = 'info';
        $data['redirect'] = 'index';
        $this->layout->view('order/msg', $data);

    }


}
