<?php

namespace App\Exports;

use App\Models\OpsLogView;
use App\AppModelsOpsLogView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OpsLogViewExport implements 
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
            'Wind Speed',
            'Temperature',
            'Visibility',
            'Operation log note',
            'Drone',
            'Flight path',
            'Pilot name',
            'Support crew',
            'Airport name',
            'Created at',
            'Completion',
            'Created by',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return AppModelsOpsLogView::all();
        // return AppModelsOpsLogView::where('id', $id);
        return collect(OpsLogView::getOpsLog($this->id));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:M1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }

    public function title(): string
    {
        return 'Operation Log';
    }
}
