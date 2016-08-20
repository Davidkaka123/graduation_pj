<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 2016/8/13
 * Time: 13:50
 */

/**
 * ������ͨ���ã�
 * set()����������
 * view()����Ⱦ��ͼ
 * ����һ��CakeResponse���󣬰���������������Ӧ
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
        //����һ��������get,put,post,delete,ajax
        if ($this->request->is('post')) {
            $this->Post->create();
            //�����û�post�ύ�ı�����
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
                $this->Flash->success(__('�����Ѿ�������'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('����ʧ��'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }
}