<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminBaseController
 *
 * @author Administrator
 */
class AdminBaseController extends Controller{
    //put your code here
    protected $pageSize = 30;
    public function init() {
        parent::init();
    }
}
