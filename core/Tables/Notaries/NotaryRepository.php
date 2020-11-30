<?php

namespace Core\Tables\Notaries;

use Throwable;

class NotaryRepository
{
    public function createNotary(
        int $number_loan,
        string $iin,
        string $identification,
        string $full_name,
        string $mobile_phone,
        string $date_of_issue,
        int $loan_term,
        int $issued_amount,
        float $delayed_od,
        float $delayed_prc,
        float $delayed_fines,
        int $number_of_day_overdue,
        array $total,
        float $notary_cost = null,
        string $email = null,
        string $residence_address = null,
        string $place_of_residence = null,
        string $home_phone = null,
        string $work_phone = null
    ): Notary
    {
        $notary = new Notary;

        $notary->number_loan = $number_loan;
        $notary->iin = $iin;
        $notary->identification = $identification;
        $notary->full_name = $full_name;
        $notary->email = $email;
        $notary->home_phone = $home_phone;
        $notary->mobile_phone = $mobile_phone;
        $notary->work_phone = $work_phone;
        $notary->residence_address = $residence_address;
        $notary->place_of_residence = $place_of_residence;
        $notary->date_of_issue = $date_of_issue;
        $notary->loan_term = $loan_term;
        $notary->issued_amount = $issued_amount;
        $notary->delayed_od = $delayed_od;
        $notary->delayed_prc = $delayed_prc;
        $notary->delayed_fines = $delayed_fines;
        $notary->number_of_day_overdue = $number_of_day_overdue;
        $notary->total = $total[0];
        $notary->notary_cost = $notary_cost;
        $notary->total_with_notary_cost = $total[1];

        $notary->saveOrFail();

        return $notary;
    }

    /**
     * @param Notary $notary
     * @param int $number_loan
     * @param string $iin
     * @param string $identification
     * @param string $full_name
     * @param string $mobile_phone
     * @param string $date_of_issue
     * @param int $loan_term
     * @param int $issued_amount
     * @param double $delayed_od
     * @param double $delayed_prc
     * @param double $delayed_fines
     * @param int $number_of_day_overdue
     * @param array $total
     * @param double|null $notary_cost
     * @param string|null $email
     * @param string|null $residence_address
     * @param string|null $place_of_residence
     * @param string|null $home_phone
     * @param string|null $work_phone
     * @return Notary
     * @throws Throwable
     */

    public function updateNotary(
        Notary $notary,
        int $number_loan,
        string $iin,
        string $identification,
        string $full_name,
        string $mobile_phone,
        string $date_of_issue,
        int $loan_term,
        int $issued_amount,
        float $delayed_od,
        float $delayed_prc,
        float $delayed_fines,
        int $number_of_day_overdue,
        array $total,
        float $notary_cost = null,
        string $email = null,
        string $residence_address = null,
        string $place_of_residence = null,
        string $home_phone = null,
        string $work_phone = null
    ): Notary

    {
        $notary->number_loan = $number_loan;
        $notary->iin = $iin;
        $notary->identification = $identification;
        $notary->full_name = $full_name;
        $notary->email = $email;
        $notary->home_phone = $home_phone;
        $notary->mobile_phone = $mobile_phone;
        $notary->work_phone = $work_phone;
        $notary->residence_address = $residence_address;
        $notary->place_of_residence = $place_of_residence;
        $notary->date_of_issue = $date_of_issue;
        $notary->loan_term = $loan_term;
        $notary->issued_amount = $issued_amount;
        $notary->delayed_od = $delayed_od;
        $notary->delayed_prc = $delayed_prc;
        $notary->delayed_fines = $delayed_fines;
        $notary->number_of_day_overdue = $number_of_day_overdue;
        $notary->total = $total[0];
        $notary->notary_cost = $notary_cost;
        $notary->total_with_notary_cost = $total[1];

        $notary->saveOrFail();

        return $notary;
    }
}