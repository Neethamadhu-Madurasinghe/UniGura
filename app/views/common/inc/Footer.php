<?php

class Footer {
    public static function render(array $jsLinks): void {
        $jsLinkString = '';
        foreach ($jsLinks as $jsLink) {
            $jsLinkString .= '<script src="' . $jsLink . '" defer></script>';
        }

        echo
           $jsLinkString .
           '    </body>
            </html>';
    }
}