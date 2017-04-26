<?php

class View
{
    private $_request;
    private $_js;
    private $_css;
    private $_acl;
    private $_rutas;
    private $_jsPlugin;
    
    public function __construct(Request $peticion, ACL $_acl) {
        $this->_request = $peticion;
        $this->_js = array();
        $this->_css = array();
        $this->_acl = $_acl;
        $this->_rutas = array();
        $this->_jsPlugin = array();
        
        $modulo = $this->_request->getModulo();
        $controlador = $this->_request->getControlador();
        
        if($modulo){
            $this->_rutas['view'] = ROOT . 'modules' . DS . $modulo . DS . 'views' . DS . $controlador . DS;
            $this->_rutas['js'] = BASE_URL . 'modules/' . $modulo . '/views/' . $controlador . '/js/';
            $this->_rutas['css'] = BASE_URL . 'modules/' . $modulo . '/views/' . $controlador . '/css/';
        }
        else{
            $this->_rutas['view'] = ROOT . 'views' . DS . $controlador . DS;
            $this->_rutas['js'] = BASE_URL . 'views/' . $controlador . '/js/';
            $this->_rutas['css'] = BASE_URL . 'views/' . $controlador . '/css/';
        }
    }
    
    public function renderizar($vista, $item = false, $noLayout = false)
    {
        $menu = array(
            array(
                'id' => 'perfil',
                'titulo' => Session::get('nombre_usuario'),
                'enlace' => '#'
                )
        );

        
        if(Session::get('autenticado')){
            $menu[] = array(
                'id' => 'login',
                'titulo' => 'Cerrar Sesion',
                'enlace' => BASE_URL . 'login/cerrar'
                );
        }else{
            $menu[] = array(
                'id' => 'login',
                'titulo' => 'Iniciar Sesion',
                'enlace' => BASE_URL . 'login'
                );
            
            $menu[] = array(
                'id' => 'registro',
                'titulo' => 'Registro',
                'enlace' => BASE_URL . 'registro'
                );
        }

        $navegacion = array(
            'controlador' => $this->_request->getControlador(),
            'metodo' => $this->_request->getMetodo(),
            'ruta' => BASE_URL . $this->_request->getControlador() .'/'
            );

        $badges = array();
        
        $js = array();
        
        if(count($this->_js)){
            $js = $this->_js;
        }
        
        $css = array();
        
        if(count($this->_css)){
            $css = $this->_css;
        }

        $_layoutParams = array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'menu' => $menu,
            'item' => $item,
            'js' => $js,
            'css' => $css,
            'js_plugin' => $this->_jsPlugin,
            'navegacion' => $navegacion,
            'badges' => $badges
        );
        
        $rutaView = $this->_rutas['view'] . $vista . '.phtml';
        
        if(is_readable($rutaView)){
            include_once ROOT . 'views'. DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            include_once $rutaView;
            include_once ROOT . 'views'. DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
        } 
        else {
            throw new Exception('Error de vista');
        }
    }
    
    public function setJs(array $js)
    {
        if(is_array($js) && count($js)){
            for($i=0; $i < count($js); $i++){
                $this->_js[] = $this->_rutas['js'] . $js[$i] . '.js';
            }
        } else {
            throw new Exception('Error de js');
        }
    }

    public function setCss(array $css)
    {
        if(is_array($css) && count($css)){
            for($i=0; $i < count($css); $i++){
                $this->_css[] = $this->_rutas['css'] . $css[$i] . '.css';
            }
        } else {
            throw new Exception('Error de css');
        }
    }

    public function setJsPlugin(array $js)
    {
        if(is_array($js) && count($js)){
            for($i=0; $i < count($js); $i++){
                $this->_jsplugin[] = BASE_URL . 'public/js/' .  $js[$i] . '.js';
            }
        } 
        else {
            throw new Exception('Error de js plugin');
        }
    }
}

?>
