<?php

namespace App\Exports;
use App\Models\Shipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class PrintMenifestExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    

    private $menifest_id;

    public function __construct($id) 
    {

        $this->menifest_id = $id;
    }
    public function collection()
    {
        $manifests =  DB::table('shipments')
                    ->join('shipment_types', 'shipments.shipment_type_id', '=', 'shipment_types.id' )
                    // ->join('couriers', 'shipments.courier_id', '=', 'couriers.id' )
                    ->where('shipments.menifest_id', '=', $this->menifest_id )
                    ->orderBy('shipments.created_at', 'desc')
                    ->get(array('shipment_types.name as shipment_type','shipments.tracking_number as tracking_number', 'shipments.vehicle as vehicle', 'shipments.executive as executive'));
 
        return  $manifests;
    }
    public function headings(): array
    {
        return [
            'Shipment Type',
            'Tracking Number',
            'Vehicle No',
            'Executive Name'
        ];
    }
}
