<?php
class Controller {
    protected function view(string $view, array $data = []) {
        extract($data);
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        require __DIR__ . '/../views/layout.php';
    }

    protected function redirect(string $path) {
        header('Location: ' . BASE_URL . 'index.php?'.$path);
        exit;
    }
}
