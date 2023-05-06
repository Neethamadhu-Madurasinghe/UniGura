<?php

class Common extends Controller{
    public function __construct() {

    }

    public function notFound(Request $request) {
        $data = [];
        header("HTTP/1.0 404 Not Found");
        $this->view('common/notFound', $request, $data);

    }

//    TODO: Put landing page here

}