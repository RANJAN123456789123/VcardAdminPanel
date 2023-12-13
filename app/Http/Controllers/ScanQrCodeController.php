<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class ScanQrCodeController extends Controller
{
    public function addToContact($id)
    {
        $getdata = UserModel::where('id', $id)->first();

        $vcardData = $this->createVcardDetails($getdata);

        return $vcardData;
    }

    private function createVcardDetails($data)
    {
        // if not used - leave blank!
        $name = $data->name . ";";
        $addressLabel     = 'Our Office';
        $addressPobox     = '';
        $addressExt       = '';
        $addemail    = $data->email;
        $addphonenumber      = $data->phone_number;
        $addressRegion    = $data->company_name;
        $addressDesgination  = $data->designation;
        $addressCountry   = 'India';

        // Build raw data
        $codeContents  = 'BEGIN:VCARD' . "\n";
        $codeContents .= 'VERSION:3.0' . "\n";
        $codeContents .= 'N:' . $name . "\n";
        $codeContents .= 'FN:' . $data->person_name . "\n";
        $codeContents .= 'ORG:' . $data->company_name . "\n";
        $codeContents .= 'EMAIL;TYPE=INTERNET:' . $data->email . "\n";
        $codeContents .= 'URL:' . $data->website . "\n";
        $codeContents .= 'TEL;TYPE=CELL:' . $data->mobile . "\n";
        $codeContents .= 'TEL:' . $data->officeno . "\n";

        $codeContents .= 'ADR;TYPE=work;' .
            'LABEL="' . $addressLabel . '":'
            . $addressPobox . ';'
            . $addressExt . ';'
            . $addemail . ';'
            . $addphonenumber . ';'
            . $addressRegion . ';'
            . $addressDesgination . ';'
            . $addressCountry
            . "\n";

        $codeContents .= 'END:VCARD';

        return $codeContents;
    }
}
