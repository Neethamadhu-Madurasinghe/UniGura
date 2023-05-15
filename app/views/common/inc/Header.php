<?php

class Header
{
    public static function render(string $title, array $cssLinks): void
    {
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
              <script src="https://kit.fontawesome.com/a9e998cba0.js" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
            </head>
            <body>
            ';
    }
}
