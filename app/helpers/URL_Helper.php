<?php

function redirect($path): void {
    if ($path[0] !== '/') {
        $path = '/' . $path;
    }
    header('location: ' . URLROOT . $path);
}


function redirectBasedOnUserRole(Request $request): void {
    if ($request->isAdmin()) {
        redirect('admin/dashboard');
    }elseif ($request->isTutor()) {
        redirect('tutor/dashboard');
    }elseif ($request->isStudent()) {
        redirect('student/dashboard');
    }elseif ($request->isEmailNotValidatedTutor()) {
        redirect('tutor/validate-email');
    }elseif ($request->isEmailNotValidatedStudent()) {
        redirect('student/validate-email');
    }elseif ($request->isProfileNotCompletedTutor()) {
        redirect('tutor/complete-profile');
    }elseif ($request->isProfileNotCompletedStudent()) {
        redirect('student/complete-profile');
    }elseif ($request->isBankDetialsNotCompletedTutor()) {
        redirect('tutor/complete-bank-detials');
    }
    elseif ($request->isTimeSlotNotCompletedTutor()) {
        redirect('tutor/tutor-time-slot-input');
    }
    elseif ($request->isNotApprovedTutor()) {
        redirect('/tutor/pending');
    }
    //new function added by sachithra
    elseif($request->isApprovedTutor()){
        redirect('tutor/aproved');
    }
}






