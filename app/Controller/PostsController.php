<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 2016/8/13
 * Time: 13:50
 */

/**
 * 控制器通常用：
 * set()创建上下文
 * view()来渲染视图
 * 返回一个CakeResponse对象，包含创建的完整响应
 *
 */
class PostsController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function view ($id = null) {
        if (! $id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }

    public function add () {
        //接受一个参数，get,put,post,delete,ajax
        if ($this->request->is('post')) {
            $this->Post->create();
            //访问用户post提交的表单数据
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }

    public function edit ($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('博客已经被更新'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('更新失败'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }
}