<?php

class FileLoader {
    public function loadFile(Request $request): void {
        if(!$request->isLoggedIn()) {
            redirect('/login');
            die('Please log in to download the file');
        }


//        if request was ...?file= error message should be displayed
//        __nofile is a dummy name used for indicate to unavailable file
        $fileName = $request->getBody()['file'] ?? '';
        $fileName = $fileName !== '' ? $fileName : '__nofile';
        $file = '..\\user_files\\' . $fileName;

        if (file_exists($file)) {
            $type = 'application/pdf';
            header('Content-Type:'.$type);
            header('Content-Length: ' . filesize($file));
            readfile($file);

        }else {
            echo 'Requested file is not available';
//            TODO: Redirect to a new page
        }


    }
}
