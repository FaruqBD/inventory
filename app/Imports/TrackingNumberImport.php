<?php

namespace App\Imports;

use App\Models\TrackingNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TrackingNumberImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TrackingNumber([
            'tracking_number'    => $row[0]
        ]);
    }
}
