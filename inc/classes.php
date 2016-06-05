<?php
/**
 * Created by PhpStorm.
 * User: szabacsik
 * Date: 2016. 06. 04.
 * Time: 9:43
 */

namespace improwerk\implement\mvc;
use improwerk\implement\mvc as mvc;


class model implements mvc\imodel
{
    private $data = array ();
    function __construct ()
    {
    }

    function __destruct ()
    {
    }

    public function getData ()
    {
        return $this -> data;
    }

    public function setData ( $action, $variables = false )
    {
        //Query the database based on $action and $variables
        switch ( $action )
        {
            case 'about':
                $this->data=array("template"=>"<h3>%title%</h3><p style='color: darkred;'>%content%</p>","title"=>"About","content"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla bibendum enim ac justo faucibus, sed sodales sem accumsan. Nunc aliquet tellus odio, sit amet ornare lacus aliquet et. Etiam auctor malesuada ipsum vel posuere. Duis nec velit sed purus volutpat facilisis. Morbi a placerat magna, eu lobortis felis. In hac habitasse platea dictumst. Vestibulum vel dolor nec dui porta malesuada. Nulla mattis odio ultricies tristique ultricies.");
            break;
            case 'blog':
                $this->data=array("template"=>"<h3>%title%</h3><p style='color: darkblue;'>%content%</p>","title"=>"Blog","content"=>"Sed malesuada dapibus nunc, sit amet mollis lorem eleifend vel. Pellentesque eleifend quam at suscipit molestie. Nulla ultrices sem ac ligula finibus, ac maximus mauris feugiat. Vestibulum urna enim, tempus eu elementum a, pretium in eros. Vivamus ut nibh volutpat, egestas mauris id, ultricies orci. Nulla eleifend nulla non lectus tincidunt, eu sagittis nisi pharetra. Integer mattis venenatis quam, id porta lacus ultricies et. Etiam ut diam tincidunt ex luctus vehicula ut id arcu.");
            break;
            case 'contact':
                $this->data=array("template"=>"<h3>%title%</h3><p style='color: darkgreen;'>%content%</p>","title"=>"Contact","content"=>"Sed molestie purus purus, eu convallis quam tincidunt at. Vivamus tortor nulla, laoreet in mi vel, maximus fermentum lorem. Aliquam dictum enim at mollis efficitur. Interdum et malesuada fames ac ante ipsum primis in faucibus. In laoreet felis rutrum sagittis dapibus. Nullam imperdiet sem vitae justo egestas, et mattis magna sagittis. Nunc ac nulla nunc. Fusce ligula velit, scelerisque quis magna nec, volutpat dignissim ante. Fusce mattis enim at malesuada malesuada. Quisque ornare leo eget molestie tristique. Suspendisse ornare, elit ac mattis rhoncus, erat ex rhoncus risus, nec fringilla purus elit nec velit. Sed rhoncus massa at justo venenatis tempus semper ut felis.");
            break;
            default:
                $this->data=array("template"=>"<h3>%title%</h3><p style='color: blueviolet;'>%content%</p>","title"=>"Home","content"=>"<strong>Welcome<br></strong>Maecenas tempus feugiat mollis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris ultrices lectus sapien, laoreet egestas erat convallis id. Morbi porttitor interdum lacus. Nullam semper, arcu vitae rhoncus tristique, leo massa malesuada lectus, imperdiet gravida dui magna sit amet enim. Fusce porttitor mi sit amet tincidunt pretium. Morbi tempus consectetur mi et fringilla. Ut sed eros gravida, faucibus erat a, sodales lorem. Nam viverra malesuada nulla, id bibendum ante lacinia et. Praesent pellentesque eros non finibus dictum.");
            break;
        }
    }
}

class view implements mvc\iview
{
    private $model;
    private $controller;
    public function __construct ( $model, $controller )
    {
        $this -> model = $model;
        $this -> controller = $controller;
    }

    public function __destruct ()
    {
    }

    public function render ()
    {
        $data = $this -> model -> getData ();
        $template = $data [ 'template' ];
        $template_key = array ();
        $template_value = array ();
        foreach ( $data as $key => $value )
        {
            $template_key [] = '%' . $key . '%';
            $template_value [] = $value;
        }
        $menu = "<ul><li><a href='index.php' target='_self'>home</a></li><li><a href='index.php?action=about' target='_self'>about</a></li><li><a href='index.php?action=contact' target='_self'>contact</a></li><li><a href='index.php?action=blog' target='_self'>blog</a></li></ul>";
        $action = $this -> controller -> getAction ();
        $result = $menu . str_replace ( $template_key, $template_value, $template ) . '<sup>' . $action . '</sup>';
        print $result;
    }

}

class controller implements mvc\icontroller
{
    private $model;
    private $route;
    public function __construct ( $model )
    {
        $this -> route = new route ();
        $this -> model = $model;
        $this -> model -> setData ( $this -> route -> getAction () );
    }
    
    public function getAction ()
    {
        return $this -> route -> getAction ();
    }

    public function __destruct ()
    {
    }
}

class route implements ibasic
{
    private $action;
    public function __construct ()
    {
        if ( isset ( $_REQUEST['action'] ) )
        {
            $this -> action = $_REQUEST [ 'action' ];
        }
        else
        {
            $this -> action = "";
        }
    }

    public function getAction ()
    {
        return $this -> action;
    }

    public function __destruct ()
    {
    }
}

