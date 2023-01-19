<?php

class Header {
    public static function render(string $title, array $cssLinks): void {
        $cssLinksString = '';
        foreach ($cssLinks as $cssLink) {
            $cssLinksString .= '<link rel="stylesheet" href="' . $cssLink . '">';
        }

        echo '
           <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">' .
              $cssLinksString .
              '<title>' . $title . '</title>
            </head>
            <body>
            ';
    }
}