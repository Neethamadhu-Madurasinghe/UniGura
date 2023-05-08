<?php

class AdminFileLoader extends Controller
{
    public function viewFiles(Request $request): void  // for tutor_detail_files folder
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
            die('Please log in to download the file');
        }

        if ($request->isAdmin()) {
            
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
                
            }
        } else {
            // header('HTTP/1.0 403 Forbidden');
            redirect('/login');
            exit;
        }
    }

    
}
