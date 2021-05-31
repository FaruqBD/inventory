<?php

namespace App\Exports;
use App\Models\Shipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ManifestExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    

    private $created_date;
    private $courier_id;

    public function __construct($created_date, $courier_id) 
    {
        $this->created_date = $created_date;
        $this->courier_id = $courier_id;
    }
    public function collection()
    {
        $manifests =  DB::table('shipments')
                    ->join('shipment_types', 'shipments.shipment_type_id', '=', 'shipment_types.id' )
                    ->join('couriers', 'shipments.courier_id', '=', 'couriers.id' )
                    ->whereDate('shipments.created_at', '=', $this->created_date)
                    ->where('shipments.courier_id', '=', $this->courier_id )
                    ->orderBy('shipments.created_at', 'desc')
                    ->get(array('shipment_types.name as shipment_type','shipments.tracking_number as tracking_number'));

        return  $manifests;
    }
    public function headings(): array
    {
        return [
            'Shipment Type',
            'Tracking Number',
        ];
    }
}
