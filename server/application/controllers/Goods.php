<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK\Constants as Constants;


class Goods extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Category_model', 'category_model');
        $this->load->model('Goods_model', 'goods_model');
    }

    public function add() {
        // 获取顶级分类
        $data['categories'] = $this->category_model->findAll();
        $data['title'] = '添加商品';
        $this->layout->view('goods/add', $data);
    }
    public function edit() {
        // 获取顶级分类
        $data['categories'] = $this->category_model->findAll();
        $objectId = $this->input->get('objectId');

        $goods=$this->goods_model->getOne($objectId);


        $data['goods'] = $goods;
        $this->layout->view('goods/edit', $data);
    }

    // 删除商品
    public function delete() {
        $objectId = $this->input->get('objectId');

        $this->goods_model->delete($objectId);
        $data['msg'] = '删除成功';
        $data['level'] = 'info';
        $data['redirect'] = 'index';
        $this->layout->view('goods/msg', $data);
    }



}
