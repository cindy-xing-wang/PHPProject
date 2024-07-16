<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class OpsLogViewMultiSheetExport implements WithMultipleSheets
{
    private $opsId;

    public function __construct($opsId)
    {
        $this->opsId = $opsId;
    }

    public function sheets(): array
    {
        $sheets = [];
        $sheets[0] = new OpsLogViewExport($this->opsId);
        $sheets[1] = new PreFlightLogViewExport($this->opsId);

        return $sheets;
    }
}
