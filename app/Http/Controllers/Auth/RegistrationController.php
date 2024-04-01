<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Mail\RegisterMail;
use App\Mail\SendOtpViaMail;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function registration(RegistrationRequest $request)
    {
        $date = Carbon::now();
        $birthdate = Carbon::parse($request->birthday);
        $yearsDifference = $date->diffInYears($birthdate);

        if ($yearsDifference < 18) {
            return response()->json([
                'status' => false,
                'message' => 'You must be 18 years old to register.'
            ], 400);
        }

        $user = User::create([
            'role_id' => $request->role_id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'name' => $request->firstname .' '. $request->lastname,
            'gender' => $request->gender,
            'birthday' =>$request->birthday,
            'phone_area_code' => $request->phone_area_code,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email_verify_token' => randon_prefix(),
        ]);

        UserAddress::create([
            'user_id' => $user->id,
            'street' => $request->street,
            'city' => $request->city,
            'province' => $request->province,
            'region' => $request->region,
            'zip_code' => $request->zip_code
        ]);

        Mail::to($user->email)->send(new RegisterMail($user->email_verify_token, $user->email, $user->name));

        return response()->json([
            'status' => true,
            'data' => $user
        ], 201);
    }

    public function fetchProvinces()
    {
        $response = Http::get('https://psgc.gitlab.io/api/provinces');
        $provinces = [];

        if ($response->successful()) {
            $provinces = collect($response->json())->map(function ($province) {
                return [
                    'code' => $province['code'],
                    'name' => $province['name'],
                ];
            })
            ->sortBy('name')
            ->values()
            ->toArray();

            $status = true;
        }

        return response()->json([
            'status' => $status ?? false,
            'data' => $provinces,
        ], 200);
    }

    public function fetchCities($provinceCode)
    {
        if (!empty($provinceCode)) {
            $response = Http::get("https://psgc.gitlab.io/api/provinces/{$provinceCode}/municipalities");

            if ($response->successful()) {
                $cities = collect($response->json())->map(function ($city) {
                    return [
                        'code' => $city['code'],
                        'name' => $city['name'],
                    ];
                })
                    ->sortBy('name')
                    ->values()
                    ->toArray();

                $status = true;
            } else {
                $cities = [];
                $status = false;
            }
        } else {
            $cities = [];
            $status = false;
        }

        return response()->json([
            'status' => $status,
            'data' => $cities
        ], 200);
    }

    public function fetchCountryCodes()
    {
        $response = Http::get('https://restcountries.com/v3.1/all?fields=name,idd');
        $countries = [];

        if ($response->successful()) {
            $countries = collect($response->json())->map(function ($country) {
                $fullCodes = [];
                $root = $country['idd']['root'] ?? '';
                $suffixes = $country['idd']['suffixes'] ?? [];

                foreach ($suffixes as $suffix) {
                    $fullCodes[] = $root . $suffix;
                }

                return [
                    'name' => $country['name']['common'],
                    'callingCodes' => $fullCodes,
                ];
            })
            ->sortBy('name')
            ->values()
            ->toArray();

            $status = true;
        }

        return response()->json([
            'status' => $status,
            'data' => $countries
        ], 200);
    }

    public function phoneSend($phoneNumber)
    {
        $otp_gen = otp_generator();
        Cache::put('otp', $otp_gen, 600);
        movider_service("+63" . $phoneNumber, $otp_gen);

        return response()->json([
            'message' => 'OTP has been sent to '. $phoneNumber
        ]);
    }

    public function emailSend($email)
    {
        $otp_gen = otp_generator();
        Cache::put('otp', $otp_gen, 600);
        Mail::to($email)->send(new SendOtpViaMail($otp_gen)); // Iisang variable, kasi pag cinall mo twice, different ang OTP

        return response()->json([
            'message' => 'OTP has been sent to '. $email
        ]);
    }

    public function verifyCode($otpCode)
    {
        $inputCode = $otpCode;
        $otp = Cache::get('otp');

        if ($otp == (int)$inputCode) {
            $status = true;
        } else {
            $status = false;
        }

        return response()->json([
            'status' => $status
        ], $status ? 200 : 400);
    }
}
