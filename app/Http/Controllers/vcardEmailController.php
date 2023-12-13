<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\UserModel;
use App\Models\contactUsModel;

class vcardEmailController extends Controller
{
    public function addFormVcardEmail(Request $request, $ToEmail)
    {

        try {
            $name = $request->input('name');
            $fromEmail = $request->input('fromEmail');
            $public_message = $request->input('message');
            $phone_number = $request->input('phone_number');
            // $subject = $request->input('subject');

            $subject = 'Contact us customer name: ' . $name;

            $Toemail = UserModel::where('email', $ToEmail)->first();

            if ($Toemail !== null) {
                $ToUserEmail = $Toemail->email;
                $data = [
                    'ToEmail' => $ToUserEmail ?? null,
                    'name' => $name ?? null,
                    'fromEmail' => $fromEmail ?? null,
                    'message' => $public_message ?? null,
                    'phone_number' => $phone_number ?? null,
                    'subject' => $subject ?? null,

                ];
                $dataemail = contactUsModel::create($data);

                Mail::raw('', function ($message) use ($ToUserEmail, $name, $subject, $phone_number, $fromEmail, $public_message) {
                    $text = "Name: $name\n";
                    $text .= "Email: $fromEmail\n";
                    $html = '<html><body><p>' . $public_message . '</p></body></html>';

                    // $phoneNumber = 'Message from ' . ' :- ' . $subject . ',' . 'Phone Number :-' . $phone_number;
                    $emailMessage = $subject . '(' . '+91' . $phone_number . ')';

                    $message->to($ToUserEmail)
                        ->subject($emailMessage)
                        ->html($html);
                });
                return response()->json([
                    'status' => 200,
                    'message' => 'email Sent successfully we will be contact as soon as possible',
                    'data' => $dataemail
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Admin email not found',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
                'Line' => $e->getLine(),
            ]);
        }
    }
}
