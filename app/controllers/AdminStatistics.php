<?php

class AdminStatistics extends Controller
{
    private mixed $statisticsModel;

    public function __construct()
    {
        $this->statisticsModel = $this->model('ModelAdminStatistics');
    }

    public function statistics(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        
        $totalStudent = $this->statisticsModel->totalStudent();
        $totalTutor = $this->statisticsModel->totalTutor();

        $hiddenTutors = $this->statisticsModel->hiddenTutors();

        $bannedTutors = $this->statisticsModel->bannedTutors();
        $bannedStudent = $this->statisticsModel->bannedStudent();

        $activeClasses = $this->statisticsModel->activeTutorialClasses();
        $completedClasses = $this->statisticsModel->completedTutorialClasses();

        $studentAmpareDistrict = $this->statisticsModel->studentAmpareDistrict();
        $studentAnuradhapuraDistrict = $this->statisticsModel->studentAnuradhapuraDistrict();
        $studentBadullaDistrict = $this->statisticsModel->studentBadullaDistrict();
        $studentBatticaloaDistrict = $this->statisticsModel->studentBatticaloaDistrict();
        $studentColomboDistrict = $this->statisticsModel->studentColomboDistrict();
        $studentGalleDistrict = $this->statisticsModel->studentGalleDistrict();
        $studentGampahaDistrict = $this->statisticsModel->studentGampahaDistrict();
        $studentHambantotaDistrict = $this->statisticsModel->studentHambantotaDistrict();
        $studentJaffnaDistrict = $this->statisticsModel->studentJaffnaDistrict();
        $studentKalutaraDistrict = $this->statisticsModel->studentKalutaraDistrict();
        $studentKandyDistrict = $this->statisticsModel->studentKandyDistrict();
        $studentKegalleDistrict = $this->statisticsModel->studentKegalleDistrict();
        $studentKilinochchiDistrict = $this->statisticsModel->studentKilinochchiDistrict();
        $studentKurunegalaDistrict = $this->statisticsModel->studentKurunegalaDistrict();
        $studentMannarDistrict = $this->statisticsModel->studentMannarDistrict();
        $studentMataleDistrict = $this->statisticsModel->studentMataleDistrict();
        $studentMataraDistrict = $this->statisticsModel->studentMataraDistrict();
        $studentMonaragalaDistrict = $this->statisticsModel->studentMonaragalaDistrict();
        $studentMullaitivuDistrict = $this->statisticsModel->studentMullaitivuDistrict();
        $studentNuwaraEliyaDistrict = $this->statisticsModel->studentNuwaraEliyaDistrict();
        $studentPolonnaruwaDistrict = $this->statisticsModel->studentPolonnaruwaDistrict();
        $studentPuttalamDistrict = $this->statisticsModel->studentPuttalamDistrict();
        $studentRatnapuraDistrict = $this->statisticsModel->studentRatnapuraDistrict();
        $studentTrincomaleeDistrict = $this->statisticsModel->studentTrincomaleeDistrict();
        $studentVavuniyaDistrict = $this->statisticsModel->studentVavuniyaDistrict();


        $tutorAmpareDistrict = $this->statisticsModel->tutorAmpareDistrict();
        $tutorAnuradhapuraDistrict = $this->statisticsModel->tutorAnuradhapuraDistrict();
        $tutorBadullaDistrict = $this->statisticsModel->tutorBadullaDistrict();
        $tutorBatticaloaDistrict = $this->statisticsModel->tutorBatticaloaDistrict();
        $tutorColomboDistrict = $this->statisticsModel->tutorColomboDistrict();
        $tutorGalleDistrict = $this->statisticsModel->tutorGalleDistrict();
        $tutorGampahaDistrict = $this->statisticsModel->tutorGampahaDistrict();
        $tutorHambantotaDistrict = $this->statisticsModel->tutorHambantotaDistrict();
        $tutorJaffnaDistrict = $this->statisticsModel->tutorJaffnaDistrict();
        $tutorKalutaraDistrict = $this->statisticsModel->tutorKalutaraDistrict();
        $tutorKandyDistrict = $this->statisticsModel->tutorKandyDistrict();
        $tutorKegalleDistrict = $this->statisticsModel->tutorKegalleDistrict();
        $tutorKilinochchiDistrict = $this->statisticsModel->tutorKilinochchiDistrict();
        $tutorKurunegalaDistrict = $this->statisticsModel->tutorKurunegalaDistrict();
        $tutorMannarDistrict = $this->statisticsModel->tutorMannarDistrict();
        $tutorMataleDistrict = $this->statisticsModel->tutorMataleDistrict();
        $tutorMataraDistrict = $this->statisticsModel->tutorMataraDistrict();
        $tutorMonaragalaDistrict = $this->statisticsModel->tutorMonaragalaDistrict();
        $tutorMullaitivuDistrict = $this->statisticsModel->tutorMullaitivuDistrict();
        $tutorNuwaraEliyaDistrict = $this->statisticsModel->tutorNuwaraEliyaDistrict();
        $tutorPolonnaruwaDistrict = $this->statisticsModel->tutorPolonnaruwaDistrict();
        $tutorPuttalamDistrict = $this->statisticsModel->tutorPuttalamDistrict();
        $tutorRatnapuraDistrict = $this->statisticsModel->tutorRatnapuraDistrict();
        $tutorTrincomaleeDistrict = $this->statisticsModel->tutorTrincomaleeDistrict();
        $tutorVavuniyaDistrict = $this->statisticsModel->tutorVavuniyaDistrict();


        $studentJanuaryPayment = $this->statisticsModel->studentJanuaryPayment();
        $studentFebruaryPayment = $this->statisticsModel->studentFebruaryPayment();
        $studentMarchPayment = $this->statisticsModel->studentMarchPayment();
        $studentAprilPayment = $this->statisticsModel->studentAprilPayment();
        $studentMayPayment = $this->statisticsModel->studentMayPayment();
        $studentJunePayment = $this->statisticsModel->studentJunePayment();
        $studentJulyPayment = $this->statisticsModel->studentJulyPayment();
        $studentAugustPayment = $this->statisticsModel->studentAugustPayment();
        $studentSeptemberPayment = $this->statisticsModel->studentSeptemberPayment();
        $studentOctoberPayment = $this->statisticsModel->studentOctoberPayment();
        $studentNovemberPayment = $this->statisticsModel->studentNovemberPayment();
        $studentDecemberPayment = $this->statisticsModel->studentDecemberPayment();


        $studentJanuaryPaymentsAmount = 0;
        $studentFebruaryPaymentsAmount = 0;
        $studentMarchPaymentsAmount = 0;
        $studentAprilPaymentsAmount = 0;
        $studentMayPaymentsAmount = 0;
        $studentJunePaymentsAmount = 0;
        $studentJulyPaymentsAmount = 0;
        $studentAugustPaymentsAmount = 0;
        $studentSeptemberPaymentsAmount = 0;
        $studentOctoberPaymentsAmount = 0;
        $studentNovemberPaymentsAmount = 0;
        $studentDecemberPaymentsAmount = 0;


        foreach ($studentJanuaryPayment as $transaction) {
            $studentJanuaryPaymentsAmount += $transaction->amount;
        }

        foreach ($studentFebruaryPayment as $transaction) {
            $studentFebruaryPaymentsAmount += $transaction->amount;
        }

        foreach ($studentMarchPayment as $transaction) {
            $studentMarchPaymentsAmount += $transaction->amount;
        }

        foreach ($studentAprilPayment as $transaction) {
            $studentAprilPaymentsAmount += $transaction->amount;
        }

        foreach ($studentMayPayment as $transaction) {
            $studentMayPaymentsAmount += $transaction->amount;
        }

        foreach ($studentJunePayment as $transaction) {
            $studentJunePaymentsAmount += $transaction->amount;
        }

        foreach ($studentJulyPayment as $transaction) {
            $studentJulyPaymentsAmount += $transaction->amount;
        }

        foreach ($studentAugustPayment as $transaction) {
            $studentAugustPaymentsAmount += $transaction->amount;
        }

        foreach ($studentSeptemberPayment as $transaction) {
            $studentSeptemberPaymentsAmount += $transaction->amount;
        }

        foreach ($studentOctoberPayment as $transaction) {
            $studentOctoberPaymentsAmount += $transaction->amount;
        }

        foreach ($studentNovemberPayment as $transaction) {
            $studentNovemberPaymentsAmount += $transaction->amount;
        }

        foreach ($studentDecemberPayment as $transaction) {
            $studentDecemberPaymentsAmount += $transaction->amount;
        }



        $tutorJanuaryWithdrawal = $this->statisticsModel->tutorJanuaryWithdrawal();
        $tutorFebruaryWithdrawal = $this->statisticsModel->tutorFebruaryWithdrawal();
        $tutorMarchWithdrawal = $this->statisticsModel->tutorMarchWithdrawal();
        $tutorAprilWithdrawal = $this->statisticsModel->tutorAprilWithdrawal();
        $tutorMayWithdrawal = $this->statisticsModel->tutorMayWithdrawal();
        $tutorJuneWithdrawal = $this->statisticsModel->tutorJuneWithdrawal();
        $tutorJulyWithdrawal = $this->statisticsModel->tutorJulyWithdrawal();
        $tutorAugustWithdrawal = $this->statisticsModel->tutorAugustWithdrawal();
        $tutorSeptemberWithdrawal = $this->statisticsModel->tutorSeptemberWithdrawal();
        $tutorOctoberWithdrawal = $this->statisticsModel->tutorOctoberWithdrawal();
        $tutorNovemberWithdrawal = $this->statisticsModel->tutorNovemberWithdrawal();
        $tutorDecemberWithdrawal = $this->statisticsModel->tutorDecemberWithdrawal();

        $tutorJanuaryWithdrawalAmount = 0;
        $tutorFebruaryWithdrawalAmount = 0;
        $tutorMarchWithdrawalAmount = 0;
        $tutorAprilWithdrawalAmount = 0;
        $tutorMayWithdrawalAmount = 0;
        $tutorJuneWithdrawalAmount = 0;
        $tutorJulyWithdrawalAmount = 0;
        $tutorAugustWithdrawalAmount = 0;
        $tutorSeptemberWithdrawalAmount = 0;
        $tutorOctoberWithdrawalAmount = 0;
        $tutorNovemberWithdrawalAmount = 0;
        $tutorDecemberWithdrawalAmount = 0;

        foreach ($tutorJanuaryWithdrawal as $transaction) {
            $tutorJanuaryWithdrawalAmount += (90/100) * $transaction->amount;
        }

        foreach ($tutorFebruaryWithdrawal as $transaction) {
            $tutorFebruaryWithdrawalAmount += (90/100) * $transaction->amount;
        }

        foreach ($tutorMarchWithdrawal as $transaction) {
            $tutorMarchWithdrawalAmount += (90/100) * $transaction->amount;
        }

        foreach ($tutorAprilWithdrawal as $transaction) {
            $tutorAprilWithdrawalAmount += (90/100) * $transaction->amount;
        }

        foreach ($tutorMayWithdrawal as $transaction) {
            $tutorMayWithdrawalAmount += (90/100) * $transaction->amount;
        }

        foreach ($tutorJuneWithdrawal as $transaction) {
            $tutorJuneWithdrawalAmount += (90/100) * $transaction->amount;
        }

        foreach ($tutorJulyWithdrawal as $transaction) {
            $tutorJulyWithdrawalAmount += (90/100) * $transaction->amount;
        }

        foreach ($tutorAugustWithdrawal as $transaction) {
            $tutorAugustWithdrawalAmount += (90/100) * $transaction->amount;
        }

        foreach ($tutorSeptemberWithdrawal as $transaction) {
            $tutorSeptemberWithdrawalAmount += (90/100) * $transaction->amount;
        }

        foreach ($tutorOctoberWithdrawal as $transaction) {
            $tutorOctoberWithdrawalAmount += (90/100) * $transaction->amount;
        }

        foreach ($tutorNovemberWithdrawal as $transaction) {
            $tutorNovemberWithdrawalAmount += (90/100) * $transaction->amount;
        }

        foreach ($tutorDecemberWithdrawal as $transaction) {
            $tutorDecemberWithdrawalAmount += (90/100) * $transaction->amount;
        }


        $systemJanuaryProfit = 0;
        $systemFebruaryProfit = 0;
        $systemMarchProfit = 0;
        $systemAprilProfit = 0;
        $systemMayProfit = 0;
        $systemJuneProfit = 0;
        $systemJulyProfit = 0;
        $systemAugustProfit = 0;
        $systemSeptemberProfit = 0;
        $systemOctoberProfit = 0;
        $systemNovemberProfit = 0;
        $systemDecemberProfit = 0;

        foreach ($tutorJanuaryWithdrawal as $transaction) {
            $systemJanuaryProfit += (10/100) * $transaction->amount;
        }

        foreach ($tutorFebruaryWithdrawal as $transaction) {
            $systemFebruaryProfit += (10/100) * $transaction->amount;
        }

        foreach ($tutorMarchWithdrawal as $transaction) {
            $systemMarchProfit += (10/100) * $transaction->amount;
        }

        foreach ($tutorAprilWithdrawal as $transaction) {
            $systemAprilProfit += (10/100) * $transaction->amount;
        }

        foreach ($tutorMayWithdrawal as $transaction) {
            $systemMayProfit += (10/100) * $transaction->amount;
        }

        foreach ($tutorJuneWithdrawal as $transaction) {
            $systemJuneProfit += (10/100) * $transaction->amount;
        }

        foreach ($tutorJulyWithdrawal as $transaction) {
            $systemJulyProfit += (10/100) * $transaction->amount;
        }

        foreach ($tutorAugustWithdrawal as $transaction) {
            $systemAugustProfit += (10/100) * $transaction->amount;
        }

        foreach ($tutorSeptemberWithdrawal as $transaction) {
            $systemSeptemberProfit += (10/100) * $transaction->amount;
        }

        foreach ($tutorOctoberWithdrawal as $transaction) {
            $systemOctoberProfit += (10/100) * $transaction->amount;
        }

        foreach ($tutorNovemberWithdrawal as $transaction) {
            $systemNovemberProfit += (10/100) * $transaction->amount;
        }

        foreach ($tutorDecemberWithdrawal as $transaction) {
            $systemDecemberProfit += (10/100) * $transaction->amount;
        }


        $data = [
            'totalStudents' => $totalStudent,
            'totalTutors' => $totalTutor,
            'hiddenTutors' => $hiddenTutors,
            'bannedTutors' => $bannedTutors,
            'bannedStudents' => $bannedStudent,
            'activeClasses' => $activeClasses,
            'completedClasses' => $completedClasses,
            'studentAmpareDistrict' => $studentAmpareDistrict,
            'studentAnuradhapuraDistrict' => $studentAnuradhapuraDistrict,
            'studentBadullaDistrict' => $studentBadullaDistrict,
            'studentBatticaloaDistrict' => $studentBatticaloaDistrict,
            'studentColomboDistrict' => $studentColomboDistrict,
            'studentGalleDistrict' => $studentGalleDistrict,
            'studentGampahaDistrict' => $studentGampahaDistrict,
            'studentHambantotaDistrict' => $studentHambantotaDistrict,
            'studentJaffnaDistrict' => $studentJaffnaDistrict,
            'studentKalutaraDistrict' => $studentKalutaraDistrict,
            'studentKandyDistrict' => $studentKandyDistrict,
            'studentKegalleDistrict' => $studentKegalleDistrict,
            'studentKilinochchiDistrict' => $studentKilinochchiDistrict,
            'studentKurunegalaDistrict' => $studentKurunegalaDistrict,
            'studentMannarDistrict' => $studentMannarDistrict,
            'studentMataleDistrict' => $studentMataleDistrict,
            'studentMataraDistrict' => $studentMataraDistrict,
            'studentMonaragalaDistrict' => $studentMonaragalaDistrict,
            'studentMullaitivuDistrict' => $studentMullaitivuDistrict,
            'studentNuwaraEliyaDistrict' => $studentNuwaraEliyaDistrict,
            'studentPolonnaruwaDistrict' => $studentPolonnaruwaDistrict,
            'studentPuttalamDistrict' => $studentPuttalamDistrict,
            'studentRatnapuraDistrict' => $studentRatnapuraDistrict,
            'studentTrincomaleeDistrict' => $studentTrincomaleeDistrict,
            'studentVavuniyaDistrict' => $studentVavuniyaDistrict,
            'tutorAmpareDistrict' => $tutorAmpareDistrict,
            'tutorAnuradhapuraDistrict' => $tutorAnuradhapuraDistrict,
            'tutorBadullaDistrict' => $tutorBadullaDistrict,
            'tutorBatticaloaDistrict' => $tutorBatticaloaDistrict,
            'tutorColomboDistrict' => $tutorColomboDistrict,
            'tutorGalleDistrict' => $tutorGalleDistrict,
            'tutorGampahaDistrict' => $tutorGampahaDistrict,
            'tutorHambantotaDistrict' => $tutorHambantotaDistrict,
            'tutorJaffnaDistrict' => $tutorJaffnaDistrict,
            'tutorKalutaraDistrict' => $tutorKalutaraDistrict,
            'tutorKandyDistrict' => $tutorKandyDistrict,
            'tutorKegalleDistrict' => $tutorKegalleDistrict,
            'tutorKilinochchiDistrict' => $tutorKilinochchiDistrict,
            'tutorKurunegalaDistrict' => $tutorKurunegalaDistrict,
            'tutorMannarDistrict' => $tutorMannarDistrict,
            'tutorMataleDistrict' => $tutorMataleDistrict,
            'tutorMataraDistrict' => $tutorMataraDistrict,
            'tutorMonaragalaDistrict' => $tutorMonaragalaDistrict,
            'tutorMullaitivuDistrict' => $tutorMullaitivuDistrict,
            'tutorNuwaraEliyaDistrict' => $tutorNuwaraEliyaDistrict,
            'tutorPolonnaruwaDistrict' => $tutorPolonnaruwaDistrict,
            'tutorPuttalamDistrict' => $tutorPuttalamDistrict,
            'tutorRatnapuraDistrict' => $tutorRatnapuraDistrict,
            'tutorTrincomaleeDistrict' => $tutorTrincomaleeDistrict,
            'tutorVavuniyaDistrict' => $tutorVavuniyaDistrict,

            'studentJanuaryPaymentsAmount' => $studentJanuaryPaymentsAmount,
            'studentFebruaryPaymentsAmount' => $studentFebruaryPaymentsAmount,
            'studentMarchPaymentsAmount' => $studentMarchPaymentsAmount,
            'studentAprilPaymentsAmount' => $studentAprilPaymentsAmount,
            'studentMayPaymentsAmount' => $studentMayPaymentsAmount,
            'studentJunePaymentsAmount' => $studentJunePaymentsAmount,
            'studentJulyPaymentsAmount' => $studentJulyPaymentsAmount,
            'studentAugustPaymentsAmount' => $studentAugustPaymentsAmount,
            'studentSeptemberPaymentsAmount' => $studentSeptemberPaymentsAmount,
            'studentOctoberPaymentsAmount' => $studentOctoberPaymentsAmount,
            'studentNovemberPaymentsAmount' => $studentNovemberPaymentsAmount,
            'studentDecemberPaymentsAmount' => $studentDecemberPaymentsAmount,

            'tutorJanuaryWithdrawalAmount' => $tutorJanuaryWithdrawalAmount,
            'tutorFebruaryWithdrawalAmount' => $tutorFebruaryWithdrawalAmount,
            'tutorMarchWithdrawalAmount' => $tutorMarchWithdrawalAmount,
            'tutorAprilWithdrawalAmount' => $tutorAprilWithdrawalAmount,
            'tutorMayWithdrawalAmount' => $tutorMayWithdrawalAmount,
            'tutorJuneWithdrawalAmount' => $tutorJuneWithdrawalAmount,
            'tutorJulyWithdrawalAmount' => $tutorJulyWithdrawalAmount,
            'tutorAugustWithdrawalAmount' => $tutorAugustWithdrawalAmount,
            'tutorSeptemberWithdrawalAmount' => $tutorSeptemberWithdrawalAmount,
            'tutorOctoberWithdrawalAmount' => $tutorOctoberWithdrawalAmount,
            'tutorNovemberWithdrawalAmount' => $tutorNovemberWithdrawalAmount,
            'tutorDecemberWithdrawalAmount' => $tutorDecemberWithdrawalAmount,

            'systemJanuaryProfit' => $systemJanuaryProfit,
            'systemFebruaryProfit' => $systemFebruaryProfit,
            'systemMarchProfit' => $systemMarchProfit,
            'systemAprilProfit' => $systemAprilProfit,
            'systemMayProfit' => $systemMayProfit,
            'systemJuneProfit' => $systemJuneProfit,
            'systemJulyProfit' => $systemJulyProfit,
            'systemAugustProfit' => $systemAugustProfit,
            'systemSeptemberProfit' => $systemSeptemberProfit,
            'systemOctoberProfit' => $systemOctoberProfit,
            'systemNovemberProfit' => $systemNovemberProfit,
            'systemDecemberProfit' => $systemDecemberProfit,
        ];

        $this->view('admin/statistics', $request, $data);
    }
}
