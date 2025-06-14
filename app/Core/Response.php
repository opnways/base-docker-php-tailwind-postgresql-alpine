<?php
namespace App\Core;

class Response {
    public function setStatusCode(int $code): void {
        http_response_code($code);
    }

    public function redirect(string $url): void {
        header("Location: $url");
    }

    public function renderView(string $view, array $params = []): string {
        $viewContent = $this->renderOnlyView($view, $params);
        return $this->layoutContent($viewContent);
    }

    protected function layoutContent(string $content): string {
        ob_start();
        include __DIR__ . '/../Views/Layouts/main.php';
        return ob_get_clean();
    }

    protected function renderOnlyView(string $view, array $params): string {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__ . '/../Views/' . $view . '.php';
        return ob_get_clean();
    }
}