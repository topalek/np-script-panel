<?php
session_start();

function render($filename, array $vars = []){
    if (is_array($vars) && ! empty($vars)){
        extract($vars);
    }
    ob_start();
    include 'header.php';
    include $filename;
    include 'footer.php';

    return ob_get_clean();
}
function getAlert(){
    if (isset($_SESSION['alert']) && $_SESSION['alert']['shown'] == false ){
        $type = 'success';
        $_SESSION['alert']['shown'] = true;
        if ($_SESSION['alert']['type'] == 'error'){
            $type = 'danger';
        }
        $html ='<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <script >
            $(".close").on("click",(e)=>{
               $(".alert").removeClass( "show" ).addClass( "hide" ).remove();
            })
</script>
            '.$_SESSION['alert']['msg'].'
        </div>';
    }else{
        $html = '';
    }
    return $html;
}
function setAlert($msg,$type = 'success '){
    $_SESSION['alert'] = ['type' => $type, 'msg' => $msg,'shown'=>false];
}

$routs = [
    ''     => 'login.php',
    'task' => 'task.php',
];
$url   = trim($_REQUEST['url']);
if (array_key_exists($url, $routs)){
    $url = $routs[$url];
}else{
    $url = "404.php";
}


echo render($url);