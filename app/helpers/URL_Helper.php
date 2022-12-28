<?php

function redirect($path): void {
    if ($path[0] !== '/') {
        $path = '/' . $path;
    }
    header('location: ' . URLROOT . $path);
}



