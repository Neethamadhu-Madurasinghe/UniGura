<?php

class ExampleDashboard extends Controller {
    private mixed $dashboardModel;

    public function __construct() {
        $this->dashboardModel = $this->model('ModelExampleDashboard');
    }


    public function dashboard(Request $request) {

        if($request->isLoggedIn()) {

            $data = ['foo' => 'bar'];
            $data['request'] = $request;
            $user = $this->dashboardModel->findUserById($request->getUserId());
            $data['name'] = $user->name;
            $data['email'] = $user->email;

            if ($request->isPost()) {
                $imagePath = handleUpload(array('.png', 'jpeg'), '\\public\\profile_pictures\\', 'image');
                $data['image'] = $imagePath;

                $filePath = handleUpload(array('.pdf'), '\\user_files\\', 'file');
                $explodedFileName = explode('/', $filePath);
                $data['filename'] = end($explodedFileName);
            }

            $this->view('example/example_dashboards/userDashboard', $request, $data);

        }else {
            redirect('/example/login');
        }
    }
}
