<?php

/**
 * @var $data
 * @var $request
 */
?>

<?php
require_once APPROOT . '/views/common/inc/Header.php';
require_once APPROOT . '/views/common/inc/Footer.php';
require_once APPROOT . '/views/tutor/inc/components/MainNavbar.php';

Header::render(
    'Tutor Chat',
    [
        URLROOT . '/public/css/tutor/base.css?v=2.2',
        URLROOT . '/public/css/tutor/chat.css?v=2.5',

    ]
);

MainNavbar::render($request);
?>


<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12" style="background: linear-gradient(180deg, #F5F3FB 0%, #FDFBFD 100%);padding: 0;border-radius: 10px;height: 780px; ;margin-bottom: 5px;">
            <h2 style="width: 100%;margin: 20px;margin-bottom: 8px;">Chats</h2>
            <div class="card chat-app" style="border: 0px;margin-top: 0px;">
                <div id="plist" class="people-list">
                    <!-- <div class="input-group" style="margin-bottom: 20px;">
                        <div class="input-group-prepend" >
                            <span class="input-group-text" style="background-color: white;border: 0px;"><i class="fa fa-search" style="border: 0px;"></i></span>
                        </div>
                        <input type="text" class="form-control"  placeholder="Search..." style="border:0Px ;border-radius: 0px;">
                    </div> -->
                    <ul class="list-unstyled chat-list mt-2 mb-0" id="list" style="overflow-y: auto; width: 100%; height: 620px;padding-right:10px ;margin-right: 0px;">
                        <li class="clearfix">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                            <div class="about">
                                <div class="name">Vincent Porter</div>
                                <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>
                            </div>
                        </li>
                        <li class="clearfix active">
                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                            <div class="about">
                                <div class="name">Aiden Chavez</div>
                                <div class="status"> <i class="fa fa-circle online"></i> online </div>
                            </div>
                        </li>
                        <li class="clearfix active">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                            <div class="about">
                                <div class="name">Mike Thomas</div>
                                <div class="status"> <i class="fa fa-circle online"></i> online </div>
                            </div>
                        </li>
                        <li class="clearfix">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                            <div class="about">
                                <div class="name">Christian Kelly</div>
                                <div class="status"> <i class="fa fa-circle offline"></i> left 10 hours ago </div>
                            </div>
                        </li>
                        <li class="clearfix">
                            <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="avatar">
                            <div class="about">
                                <div class="name">Monica Ward</div>
                                <div class="status"> <i class="fa fa-circle online"></i> online </div>
                            </div>
                        </li>
                        <li class="clearfix">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                            <div class="about">
                                <div class="name">Dean Henry</div>
                                <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>
                            </div>
                        </li>
                        <li class="clearfix">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                            <div class="about">
                                <div class="name">Dean Henry</div>
                                <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>
                            </div>
                        </li>
                        <li class="clearfix">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                            <div class="about">
                                <div class="name">Dean Henry</div>
                                <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>
                            </div>
                        </li>
                        <li class="clearfix">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                            <div class="about">
                                <div class="name">Dean Henry</div>
                                <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>
                            </div>
                        </li>
                        <li class="clearfix">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                            <div class="about">
                                <div class="name">Dean Henry</div>
                                <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>
                            </div>
                        </li>
                        <li class="clearfix">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">
                            <div class="about">
                                <div class="name">Dean Henry</div>
                                <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="chat" style="background: white;margin-right:20px; margin-bottom: 20px;border-radius: 10px;">
                    <div class="chat-header clearfix">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar" id="main-chat-image">
                                </a>
                                <div class="chat-about">
                                    <h6 class="m-b-0">Aiden Chavez</h6>
                                    <small id="user-state">Last seen: 2 hours ago</small>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6 hidden-sm text-right">
                                <a href="javascript:void(0);" id="header_btn" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                                <a href="javascript:void(0);" id="header_btn" class="btn btn-outline-secondary"><i class="fa fa-image"></i></a>
                                <a href="javascript:void(0);" id="header_btn" class="btn btn-outline-secondary"><i class="fa fa-file"></i></a>
                                <a href="javascript:void(0);" id="header_btn" class="btn btn-outline-secondary"><i class="fa fa-ellipsis-h" style="transform: rotate(90deg);"></i></a>
                            </div> -->
                        </div>
                    </div>
                    <div class="chat-history">
                        <ul class="m-b-0" style="overflow-y: auto; width: 100%; height: 490px;padding-right:10px ;margin-right: 0px;">
                            <li class="clearfix">
                                <div class="message-data text-right">
                                    <div class="message other-messages float-right"> Hi Aiden, how are you? How is the project coming along? </div>
                                </div>
                                <span class="message-data-time-right">10:10 AM, Today</span>

                            </li>
                            <li class="clearfix">
                                <div class="message-data">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                    <div class="message my-message">Are we meeting today?</div>
                                </div>
                                <span class="message-data-time">10:12 AM, Today</span>

                            </li>
                            <li class="clearfix">
                                <div class="message-data">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                    <div class="message my-message">Project has been already finished and I have results to show you.</div>
                                </div>
                                <span class="message-data-time">10:15 AM, Today</span>

                            </li>
                            <li class="clearfix">
                                <div class="message-data text-right">
                                    <div class="message other-messages float-right"> Hi Aiden, how are you? How is the project coming along? </div>
                                </div>
                                <span class="message-data-time-right">10:16 AM, Today</span>

                            </li>
                            <li class="clearfix">
                                <div class="message-data text-right">
                                    <div class="message other-messages float-right"> Hi Aiden, how are you? How is the project coming along? </div>
                                </div>
                                <span class="message-data-time-right">10:17 AM, Today</span>

                            </li>
                            <li class="clearfix">
                                <div class="message-data">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                    <div class="message my-message">Are we meeting today?</div>
                                </div>
                                <span class="message-data-time">10:18 AM, Today</span>

                            </li>
                            <li class="clearfix">
                                <div class="message-data text-right">
                                    <div class="message other-messages float-right"> Hi Aiden, how are you? How is the project coming along? </div>
                                </div>
                                <span class="message-data-time-right">10:20 AM, Today</span>
                            </li>
                        </ul>
                    </div>
                    <div class="chat-message clearfix">
                        <div class="input-group mb-0" id="type">

                            <input id="msg-box" type="text" class="form-control" style="border:0Px ;border-top: 1px solid rgba(134, 134, 136, 0.158);border-radius: 0px;font-size:16px;" placeholder="Enter text here...">
                            <div id="btn-send" class="input-group-prepend" style="border-top: 1px solid rgba(134, 134, 136, 0.158)">
                                <span class="input-group-text" style="background-color: rgb(255, 255, 255);border:0Px;border-radius: 0px; width:100%"><i class="fa fa-send" style="color: white;     background: linear-gradient(180deg, #F7711A 0%, #FFA620 100%);padding: 8px;border-radius: 50%;cursor:pointer;margin:7px"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<?php Footer::render(
    [
        URLROOT . '/public/js/tutor/tutor-main.js?v=1.2',
        URLROOT . '/public/js/tutor/chat.js',
        URLROOT . '/public/js/tutor/chat-connection.js'
    ]
);
?>