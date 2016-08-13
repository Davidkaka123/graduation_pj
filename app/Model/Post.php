<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 2016/8/13
 * Time: 13:48
 */
class Post extends AppModel {
    public $validate = array(
        'title' => array('rule' => 'notBlank'),
        'body' => array('rule' => 'notBlank')
    );
}