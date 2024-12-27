<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function getPaymentUrl(Request $request)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:1'
            ]);
            $vnp_TmnCode = "LSXIPOBM";
            $vnp_HashSecret = "H5NI6H36V1HQPDW4UT9NE41Y8LY1JV0X";
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost:3000/user/return-vnpay";

            $vnp_TxnRef = date("YmdHis");
            $vnp_OrderInfo = "Thanh toán hóa đơn phí dịch vụ";
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $request->input('amount') * 100;
            $vnp_Locale = 'vn';
            $vnp_IpAddr = $request->ip();

            $inputData = [
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            ];

            ksort($inputData);

            $hashdata = urldecode(http_build_query($inputData));
            $query = http_build_query($inputData);

            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

            $vnp_Url = $vnp_Url . "?" . $query . "&vnp_SecureHash=" . $vnpSecureHash;
            Log::info('VNPay Payment URL generated', [
                'amount' => $vnp_Amount,
                'txnRef' => $vnp_TxnRef,
                'url' => $vnp_Url
            ]);
            return response()->json([
                'status' => 'success',
                'url' => $vnp_Url
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('VNPay Validation Error', [
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('VNPay Payment Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra khi xử lý thanh toán',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
