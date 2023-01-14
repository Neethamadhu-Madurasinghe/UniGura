<?php

class Footer {
    private array $jsLinks;

    public function __construct(array $jsLinks) {
        $this->jsLinks = $jsLinks;
    }

    public function render(): void {
        $jsLinks = '';
        foreach ($this->jsLinks as $jsLink) {
            $jsLinks .= '<script src="' . $jsLink . '"></script>';
        }

        echo
           $jsLinks .
           '    </body>
            </html>';
    }
}