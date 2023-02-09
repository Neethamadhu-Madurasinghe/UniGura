<?php

class StudentClass extends Controller {

    public function tutoringClass(Request $request) {
        $data = [];

        $this->view('/student/tutoringClass', $request, $data);
    }

    public function chat(Request $request) {
        $data = [];

        $this->view('/student/chat', $request, $data);
    }
}