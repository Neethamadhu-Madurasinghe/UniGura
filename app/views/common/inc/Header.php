<?php

class Header {
    private string $title;
    private array $cssLinks;

    public function __construct(string $title, array $cssLinks) {
        $this->title = $title;
        $this->cssLinks = $cssLinks;
    }

    public function render(): void {
        $cssLinks = '';
        foreach ($this->cssLinks as $cssLink) {
            $cssLinks .= '<link rel="stylesheet" href="' . $cssLink . '">';
        }

        echo '
           <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">' .
              $cssLinks .
              '<title>' . $this->title . '</title>
            </head>';
    }
}