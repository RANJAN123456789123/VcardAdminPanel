<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhonePeController extends Controller
{
    public function makePhonePePayment(Request $request)
    {

        $merchantId = 'PGTESTPAYUAT'; // sandbox or test merchantId
        $apiKey = "099eb0cd-02cf-4e2a-8aca-3e6c6aff0399"; // sandbox or test APIKEY
        $redirectUrl = route('phonepe.payment.callback');

        // Set transaction details
        $order_id = uniqid();
        $name = "Tutorials Website";
        $email = "info@tutorialswebsite.com";
        $mobile = 9999999999;
        $amount = 555; // amount in INR
        $description = 'Payment for Product/Service';

        $paymentData = array(
            'merchantId' => $merchantId,
            'merchantTransactionId' => "MT7850590068188104", // test transactionID
            "merchantUserId" => "MUID123",
            'amount' => $amount * 100,
            'redirectUrl' => $redirectUrl,
            'redirectMode' => "POST",
            'callbackUrl' => $redirectUrl,
            "merchantOrderId" => $order_id,
            "mobileNumber" => $mobile,
            "message" => $description,
            "email" => $email,
            "shortName" => $name,
            "paymentInstrument" => array(
                "type" => "PAY_PAGE",
            )
        );


        $jsonencode = json_encode($paymentData);
        $payloadMain = base64_encode($jsonencode);
        $salt_index = 1; //key index 1
        $payload = $payloadMain . "/pg/v1/pay" . $apiKey;
        $sha256 = hash("sha256", $payload);
        $final_x_header = $sha256 . '###' . $salt_index;
        $request = json_encode(array('request' => $payloadMain));

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "X-VERIFY: " . $final_x_header,
                "accept: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $res = json_decode($response);
            if (isset($res->success) && $res->success == '1') {
                $paymentCode = $res->code;
                $paymentMsg = $res->message;
                $payUrl = $res->data->instrumentResponse->redirectInfo->url;

                $transactionId = isset($res->data->merchantTransactionId)
                    ? $res->data->merchantTransactionId
                    : null;

                $encryptedPaymentData = encrypt($paymentData);
                session(['payment_data' => $encryptedPaymentData]);

                return redirect()->to($payUrl);
            }
        }
    }

    public function phonePeCallback(Request $request)
    {
        $input = $request->all();
        $transactionDetails = session()->get('payment_data');
        $merchantId = $input['merchantId'] ?? null;
        $transactionId = $input['transactionId'] ?? null;
        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;
        $finalXHeader = hash('sha256', '/pg/v1/status/' . $merchantId . '/' . $transactionId . $saltKey) . '###' . $saltIndex;

        $curl = curl_init();
        if (!$transactionDetails && $merchantId && $transactionId) {
            $merchantId = $input['merchantId'];
            $transactionId = $input['transactionId'];
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/status/' . $merchantId . '/' . $transactionId,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'accept: application/json',
                    'X-VERIFY: ' . $finalXHeader,
                    'X-MERCHANT-ID: ' . $transactionId // Should this be $merchantId instead?
                ),
            ));

            $response = curl_exec($curl);

            if ($response) {
                $responseObject = json_decode($response);

                if ($responseObject->success === true && $responseObject->code === "PAYMENT_PENDING") {
                    echo "Payment is pending.\n";
                    // Call function to check payment status
                    $this->checkPaymentStatus($merchantId, $transactionId);
                } elseif ($responseObject->success === true && $responseObject->code === "PAYMENT_SUCCESS") {
                    echo "Payment successful.\n";
                    // Clear transaction details from the session after successful payment
                    $request->session()->forget('transaction_details');
                } elseif ($responseObject->success === false && $responseObject->code === "PAYMENT_ERROR") {
                    echo "Payment error occurred.\n";
                    // Clear transaction details from the session after payment error
                    $request->session()->forget('transaction_details');
                }
            } else {
                echo "Error in API response.\n";
            }

            curl_close($curl);
        } else {
            $merchantId = $input['merchantId'];
            $transactionId = $input['transactionId'];
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/status/' . $merchantId . '/' . $transactionId,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'accept: application/json',
                    'X-VERIFY: ' . $finalXHeader,
                    'X-MERCHANT-ID: ' . $transactionId // Should this be $merchantId instead?
                ),
            ));

            $response = curl_exec($curl);

            if ($response) {
                $responseObject = json_decode($response);

                if ($responseObject->success === true && $responseObject->code === "PAYMENT_PENDING") {
                    echo "Payment is pending.\n";
                    $this->checkPaymentStatus($merchantId, $transactionId);
                } elseif ($responseObject->success === true && $responseObject->code === "PAYMENT_SUCCESS") {
                    echo "Payment successful.\n";
                } elseif ($responseObject->success === false && $responseObject->code === "PAYMENT_ERROR") {
                    echo "Payment error occurred.\n";
                }
            } else {
                echo "Error in API response.\n";
            }

            curl_close($curl);
        }
    }


    public function checkPaymentStatus($merchantId, $transactionId)
    {
        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;
        // The initial wait time after transaction start (20-25 seconds)
        $initialWaitTime = rand(20, 25);
        sleep($initialWaitTime);

        $totalTimeElapsed = $initialWaitTime;
        $intervals = [
            3, 3, 3, // Every 3 seconds for the next 30 seconds
            6, 6, 6, // Every 6 seconds for the next 60 seconds
            10, 10, 10, // Every 10 seconds for the next 60 seconds
            30, 30, 30, // Every 30 seconds for the next 60 seconds
        ];

        $curl = curl_init();
        // Assuming $merchantId and $transactionId are valid
        if ($merchantId && $transactionId) {
            foreach ($intervals as $interval) {
                sleep($interval);
                $totalTimeElapsed += $interval;

                $finalXHeader = hash('sha256', '/pg/v1/status/' . $merchantId . '/' . $transactionId . $saltKey) . '###' . $saltIndex;

                // Make the API call to check payment status
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/status/' . $merchantId . '/' . $transactionId,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => false,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'accept: application/json',
                        'X-VERIFY: ' . $finalXHeader,
                        'X-MERCHANT-ID: ' . $transactionId // Should this be $merchantId instead?
                    ),
                ));

                $response = curl_exec($curl);

                if ($response) {
                    $responseObject = json_decode($response);

                    if ($responseObject->success === true && $responseObject->code === "PAYMENT_PENDING") {
                        echo "Payment is still pending. Elapsed Time: $totalTimeElapsed seconds\n";
                    } elseif ($responseObject->success === true && $responseObject->code === "PAYMENT_SUCCESS") {
                        echo "Payment was successful.\n";
                        break; // Exit loop if payment is successful
                    } elseif ($responseObject->success === false && $responseObject->code === "PAYMENT_ERROR") {
                        echo "Payment error occurred.\n";
                        break; // Exit loop if payment error occurs
                    }
                } else {
                    echo "Error in API response.\n";
                    break; // Exit loop if there's an issue with the API response
                }
            }

            curl_close($curl);
        }
    }


    // Refund API from api
    public function phonePeRefundAPI(Request $request, $tra_id)
    {
        $amount = session()->get('refund_api') ?? 100;
        $payload = [
            'merchantId' => 'MERCHANTUAT',
            'merchantUserId' => 'MUID123',
            'merchantTransactionId' => ($tra_id),
            'originalTransactionId' => strrev($tra_id),
            'amount' => $amount * 100,
            'callbackUrl' => route('phonepe.payment.callback'),
        ];

        $encode = base64_encode(json_encode($payload));

        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;

        $string = $encode . '/pg/v1/refund' . $saltKey;
        $sha256 = hash('sha256', $string);

        $finalXHeader = $sha256 . '###' . $saltIndex;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/refund',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'X-VERIFY: ' . $finalXHeader
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $rData = json_decode($response);

        $finalXHeader1 = hash('sha256', '/pg/v1/status/' . 'MERCHANTUAT' . '/' . $tra_id . $saltKey) . '###' . $saltIndex;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/status/' . 'MERCHANTUAT' . '/' . $tra_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'accept: application/json',
                'X-VERIFY: ' . $finalXHeader1,
                'X-MERCHANT-ID: ' . $tra_id
            ),
        ));

        $responsestatus = curl_exec($curl);
        $suceess_data = json_decode($responsestatus);
        curl_close($curl);

        dd(json_decode($response), $suceess_data, $suceess_data->data->transactionId);
        // dd($rData);
    }
}
