<?php

namespace App\Controllers;

class IndexController extends BaseController {
    
    public function IndexAction() {
        $data = ['message' => 'Hola mundo'];
        $this->renderHTML('../view/index_view.php', $data);
    }

    public function SaludoAction($request) {
        $partes = explode("/", $request);
        $nombre = end($partes);
        $message = "Hola $nombre";
        $data = ['message' => $message];
        $this->renderHTML('../view/index_view.php', $data);
    }
}



    