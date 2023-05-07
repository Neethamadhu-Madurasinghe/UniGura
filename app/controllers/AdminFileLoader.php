<?php

class AdminFileLoader extends Controller
{
    public function viewFiles(Request $request): void
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
            die('Please log in to download the file');
        }

        if ($request->isAdmin()) {
            //        if request was ...?file= error message should be displayed
            //        __nofile is a dummy name used for indicate to unavailable file
            $fileName = $request->getBody()['file'] ?? '';
            $fileName = $fileName !== '' ? $fileName : '__nofile';
            $file = '..\\' . $fileName;

            $file_extension = pathinfo($file, PATHINFO_EXTENSION);

            $content_types = array(
                'pdf' => 'application/pdf',
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
            );


            if (file_exists($file)) {
                $type = $content_types[$file_extension];
                header('Content-Type:' . $type);
                header('Content-Length: ' . filesize($file));
                readfile($file);
                exit;
            } else {
                echo 'Requested file is not available';
                //            TODO: Redirect to a new page
            }
        } else {
            // header('HTTP/1.0 403 Forbidden');
            redirect('/login');
            exit;
        }
    }
}
