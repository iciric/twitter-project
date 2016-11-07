<?php

namespace Views;

abstract class AbstractView implements View {

    public function render() {
        ob_start();

        $this->outputHTML();

        return ob_get_clean();
    }

    protected abstract function outputHTML();

    public function __toString() {
        return $this->render();
    }

}