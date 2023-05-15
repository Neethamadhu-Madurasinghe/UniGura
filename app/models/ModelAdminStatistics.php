<?php

class ModelAdminStatistics{

    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function totalStudent(){
        $this->db->query("SELECT * FROM student");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function totalTutor(){
        $this->db->query("SELECT * FROM tutor");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function hiddenTutors(){
        $this->db->query("SELECT * FROM tutor WHERE is_hidden = 1");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function bannedTutors(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.is_banned = 1");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function bannedStudent(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.is_banned = 1");
        $this->db->resultAll();
        return $this->db->rowCount();
    }


    public function activeTutorialClasses(){
        $this->db->query("SELECT * FROM  tutoring_class WHERE completion_status = 0");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function completedTutorialClasses(){
        $this->db->query("SELECT * FROM  tutoring_class WHERE completion_status = 1");
        $this->db->resultAll();
        return $this->db->rowCount();
    }




    public function studentAmpareDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Ampare'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentAnuradhapuraDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Anuradhapura'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentBadullaDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Badulla'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentBatticaloaDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Batticaloa'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentColomboDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Colombo'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentGalleDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Galle'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentGampahaDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Gampaha'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentHambantotaDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Hambantota'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentJaffnaDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Jaffna'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentKalutaraDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Kalutara'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentKandyDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Kandy'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentKegalleDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Kegalle'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentKilinochchiDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Kilinochchi'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentKurunegalaDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Kurunegala'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentMannarDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Mannar'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentMataleDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Matale'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentMataraDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Matara'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentMonaragalaDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Monaragala'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentMullaitivuDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Mullaitivu'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentNuwaraEliyaDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Nuwara Eliya'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentPolonnaruwaDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Polonnaruwa'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentPuttalamDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Puttalam'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentRatnapuraDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Ratnapura'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentTrincomaleeDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Trincomalee'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function studentVavuniyaDistrict(){
        $this->db->query("SELECT * FROM student,user WHERE student.user_id = user.id AND user.district = 'Vavuniya'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }




    public function tutorAmpareDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Ampare'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorAnuradhapuraDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Anuradhapura'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorBadullaDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Badulla'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorBatticaloaDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Batticaloa'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorColomboDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Colombo'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorGalleDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Galle'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorGampahaDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Gampaha'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorHambantotaDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Hatton'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorJaffnaDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Jaffna'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorKalutaraDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Kalutara'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorKandyDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Kandy'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorKegalleDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Kegalle'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorKilinochchiDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Kilinochchi'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorKurunegalaDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Kurunegala'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorMannarDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Mannar'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorMataleDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Matale'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorMataraDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Matara'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorMonaragalaDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Monaragala'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorMullaitivuDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Mullaitivu'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorNuwaraEliyaDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Nuwara Eliya'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorPolonnaruwaDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Polonnaruwa'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorPuttalamDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Puttalam'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorRatnapuraDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Ratnapura'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorTrincomaleeDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Trincomalee'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function tutorVavuniyaDistrict(){
        $this->db->query("SELECT * FROM tutor,user WHERE tutor.user_id = user.id AND user.district = 'Vavuniya'");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    


    public function studentJanuaryPayment(){
        $this->db->query("SELECT * FROM payment WHERE timestamp LIKE '____-01-%'");
        return $this->db->resultAll();
    }

    public function studentFebruaryPayment(){
        $this->db->query("SELECT * FROM payment WHERE timestamp LIKE '____-02-%'");
        return $this->db->resultAll();
    }

    public function studentMarchPayment(){
        $this->db->query("SELECT * FROM payment WHERE timestamp LIKE '____-03-%'");
        return $this->db->resultAll();
    }

    public function studentAprilPayment(){
        $this->db->query("SELECT * FROM payment WHERE timestamp LIKE '____-04-%'");
        return $this->db->resultAll();
    }

    public function studentMayPayment(){
        $this->db->query("SELECT * FROM payment WHERE timestamp LIKE '____-05-%'");
        return $this->db->resultAll();
    }

    public function studentJunePayment(){
        $this->db->query("SELECT * FROM payment WHERE timestamp LIKE '____-06-%'");
        return $this->db->resultAll();
    }

    public function studentJulyPayment(){
        $this->db->query("SELECT * FROM payment WHERE timestamp LIKE '____-07-%'");
        return $this->db->resultAll();
    }

    public function studentAugustPayment(){
        $this->db->query("SELECT * FROM payment WHERE timestamp LIKE '____-08-%'");
        return $this->db->resultAll();
    }

    public function studentSeptemberPayment(){
        $this->db->query("SELECT * FROM payment WHERE timestamp LIKE '____-09-%'");
        return $this->db->resultAll();
    }

    public function studentOctoberPayment(){
        $this->db->query("SELECT * FROM payment WHERE timestamp LIKE '____-10-%'");
        return $this->db->resultAll();
    }

    public function studentNovemberPayment(){
        $this->db->query("SELECT * FROM payment WHERE timestamp LIKE '____-11-%'");
        return $this->db->resultAll();
    }

    public function studentDecemberPayment(){
        $this->db->query("SELECT * FROM payment WHERE timestamp LIKE '____-12-%'");
        return $this->db->resultAll();
    }


    public function tutorJanuaryWithdrawal(){
        $this->db->query("SELECT * FROM payment WHERE withdrawal_day LIKE '____-01-%' AND is_withdrawed = '1'");
        return $this->db->resultAll();
    }

    public function tutorFebruaryWithdrawal(){
        $this->db->query("SELECT * FROM payment WHERE withdrawal_day LIKE '____-02-%' AND is_withdrawed = '1'");
        return $this->db->resultAll();
    }

    public function tutorMarchWithdrawal(){
        $this->db->query("SELECT * FROM payment WHERE withdrawal_day LIKE '____-03-%' AND is_withdrawed = '1'");
        return $this->db->resultAll();
    }

    public function tutorAprilWithdrawal(){
        $this->db->query("SELECT * FROM payment WHERE withdrawal_day LIKE '____-04-%' AND is_withdrawed = '1'");
        return $this->db->resultAll();
    }

    public function tutorMayWithdrawal(){
        $this->db->query("SELECT * FROM payment WHERE withdrawal_day LIKE '____-05-%' AND is_withdrawed = '1'");
        return $this->db->resultAll();
    }

    public function tutorJuneWithdrawal(){
        $this->db->query("SELECT * FROM payment WHERE withdrawal_day LIKE '____-06-%' AND is_withdrawed = '1'");
        return $this->db->resultAll();
    }

    public function tutorJulyWithdrawal(){
        $this->db->query("SELECT * FROM payment WHERE withdrawal_day LIKE '____-07-%' AND is_withdrawed = '1'");
        return $this->db->resultAll();
    }

    public function tutorAugustWithdrawal(){
        $this->db->query("SELECT * FROM payment WHERE withdrawal_day LIKE '____-08-%' AND is_withdrawed = '1'");
        return $this->db->resultAll();
    }

    public function tutorSeptemberWithdrawal(){
        $this->db->query("SELECT * FROM payment WHERE withdrawal_day LIKE '____-09-%' AND is_withdrawed = '1'");
        return $this->db->resultAll();
    }

    public function tutorOctoberWithdrawal(){
        $this->db->query("SELECT * FROM payment WHERE withdrawal_day LIKE '____-10-%' AND is_withdrawed = '1'");
        return $this->db->resultAll();
    }

    public function tutorNovemberWithdrawal(){
        $this->db->query("SELECT * FROM payment WHERE withdrawal_day LIKE '____-11-%' AND is_withdrawed = '1'");
        return $this->db->resultAll();
    }

    public function tutorDecemberWithdrawal(){
        $this->db->query("SELECT * FROM payment WHERE withdrawal_day LIKE '____-12-%' AND is_withdrawed = '1'");
        return $this->db->resultAll();
    }



    public function getUserFeedbackOneRating(){
        $this->db->query("SELECT * FROM user_feedback WHERE rate = 1");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function getUserFeedbackTwoRating(){
        $this->db->query("SELECT * FROM user_feedback WHERE rate = 2");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function getUserFeedbackThreeRating(){
        $this->db->query("SELECT * FROM user_feedback WHERE rate = 3");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function getUserFeedbackFourRating(){
        $this->db->query("SELECT * FROM user_feedback WHERE rate = 4");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function getUserFeedbackFiveRating(){
        $this->db->query("SELECT * FROM user_feedback WHERE rate = 5");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    public function getTotalUserFeedbackRating(){
        $this->db->query("SELECT IFNULL(SUM(rate), 0) as totalStars FROM user_feedback");
        return $this->db->resultOne();
    }

    public function getTotalUserGiveFeedback(){
        $this->db->query("SELECT * FROM user_feedback");
        $this->db->resultAll();
        return $this->db->rowCount();
    }

    
    

}