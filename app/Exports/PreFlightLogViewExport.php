<?php

namespace App\Exports;

use App\Models\PreFlightLogView;
use App\AppModelsPreFlightLogView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PreFlightLogViewExport implements 
        FromCollection,
        WithHeadings, 
        ShouldAutoSize,
        WithEvents,
        WithTitle
{
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function headings():array {
        return[
            'Operation_id',
            'Procedure_id',
            'Procedure Name',
            'Procedure completion',
            'Pre-flight log note',
            'Tasks comepleted',
            'Created at',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(PreFlightLogView::getPreFlightLog($this->id));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }

    public function title(): string
    {
        return 'Pre-Flight Log';
    }
}
