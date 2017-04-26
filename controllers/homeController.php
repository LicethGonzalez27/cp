<?php

class homeController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        //$post = $this->loadModel('post');
        
        //$this->_view->posts = $post->getPosts();
        
        $this->_view->titulo = 'Menu principal';
        $this->_view->renderizar('index', 'home');
    }
}

?>