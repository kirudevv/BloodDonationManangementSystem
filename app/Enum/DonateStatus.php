<?php

namespace App\Enum;

enum DonateStatus: string{
    case SCREENING = 'Screening';
    case APPROVED = 'Approved';
    case REJECTED = 'Rejected';
}
?>