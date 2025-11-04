<?php

namespace App\Controllers;

class NumeroController extends BaseController {
    
    public function ParAction($request) {
        
        $numbers = [];
        for ($i = 0; $i < 10; $i++) {
            $numbers[] = $i * 2; 
        }

        $data = ['message' => '10 primeros números pares', 
                'numbers' => $numbers];

        $this->renderHTML('../view/index_view.php', $data);
    }

    public function ImparAction($request) {
        
        $numbers = [];
        for ($i = 0; $i < 10; $i++) {
            $numbers[] = $i * 2 + 1; 
        }

        $data = ['message' => '10 primeros números impares', 
                'numbers' => $numbers];

        $this->renderHTML('../view/index_view.php', $data);
    }

    public function NumImparAction($request) {
        $partes = explode("/", $request);
        $num = end($partes);

        $numbers = [];
        for ($i = 0; $i < $num; $i++) {
            $numbers[] = $i * 2 + 1; 
        }
        $data = ['message' => $num . ' primeros números impares', 
                'numbers' => $numbers];
        $this->renderHTML('../view/index_view.php', $data);
    }

    public function NumParAction($request) {
        $partes = explode("/", $request);
        $num = end($partes);

        $numbers = [];
        for ($i = 0; $i < $num; $i++) {
            $numbers[] = $i * 2; 
        }
        $data = ['message' => $num . ' primeros números pares', 
                'numbers' => $numbers];
        $this->renderHTML('../view/index_view.php', $data);
    }

}
