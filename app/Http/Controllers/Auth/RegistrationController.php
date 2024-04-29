<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Mail\RegisterMail;
use App\Mail\SendOtpViaMail;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserNotificationSettings;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Psr\Http\Client\NetworkExceptionInterface;

class RegistrationController extends Controller
{
    public function registration(Request $request)
    {

        try{
            $user = User::create([
                'role_id' => 4,
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
                'zip_code' => $request->zip_code,
                'is_default' => 1
            ]);
    
            UserNotificationSettings::create([
                'user_id' => $user->id
            ]);

            Mail::to($user->email)->send(new RegisterMail($user->email_verify_token, $user->email, $user->name));

        } catch (\Throwable $th){
            Log::error('Registration Failed ' . $th->getMessage());
            return response()->json([
                'status'=>500,
                'message'=> 'Registration Failed.'
            ], 500);
        } catch(ValidationException $e){
            return response()->json([
                'status'=>422,
                'message' => "Validation Error " . $e->getMessage()
            ], 422);
        } catch (QueryException $e){
            Log::error('Database query failed: ' . $e->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'Database error. Something went wrong'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'data' => $user
        ], 200);
    }

    public function registrationEmailCheck(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string|email',
        ]);

        try{
            $emailChecker = User::where('email', $validatedData['email'])->count();
        }catch(\Throwable $th){
            Log::error('Failed to query email checker ' . $th->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred to query email checker'
            ], 500);
        }

        if($emailChecker <= 0){
            return response()->json([
                'status' => 200,
                'data' => $emailChecker,
                'message' => 'Does not exist'
            ], 200);
        }

        if($emailChecker >= 0){
            return response()->json([
                'status' => 200,
                'data' => $emailChecker,
                'message' => 'User exist'
            ], 200);
        }

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

        } elseif ($response->clientError()){
            Log::error('Client error while fetching provinces');
            return response()->json([
                'status'=> 400,
                'message'=>'Failed to fetch provinces due to client error'
            ],400);
        } elseif($response->serverError()){
            Log::error('Server error while fetching provinces');
            return response()->json([
                'status'=> 500,
                'message' => 'Failed to fetch provinces due to server error'
            ], 500);
        }

        return response()->json([
            'status' => 200,
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

            }elseif($response->clientError()){
                Log::error('Client error while fetching cities');
                return response()->json([
                    'status'=> 400,
                    'message'=>'Failed to fetch cities due to client error'
                ],400);
            } elseif($response->serverError()){
                Log::error('Server error while fetching cities');
                return response()->json([
                    'status'=> 500,
                    'message' => 'Failed to fetch cities due to server error'
                ], 500);
            } 
        } else{
            Log::error('Something went wrong. Please check if province code is provided.');
            return response()->json([
                'status' => 400,
                'message' => 'Fetching cities failed. Please check if province code is provided'
            ], 400);
        }

        return response()->json([
            'status' => 200,
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

        }elseif($response->clientError()){
            Log::error('Client error occurred while fetching country');
            return response()->json([
                'status'=> 400,
                'message'=>'Failed to fetch countries due to client error'
            ], 400);
        }elseif($response->serverError()){
            Log::error('Server error while fetching country');
            return response()->json([
                'status'=> 500,
                'message' => 'Failed to fetch country due to server error'
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'data' => $countries
        ], 200);
    }

    public function phoneSend($phoneNumber)
    {
        try{
            $otp_gen = otp_generator();
            Cache::put('otp', $otp_gen, 600);
            movider_service("+63" . $phoneNumber, $otp_gen);
        }catch(NetworkExceptionInterface $e){
            return response()->json([
                'status'=>503,
                'message'=>'Network error. Please try again later'
            ], 503);
        } catch(\Exception $e){
            Log::error('Failed to send OTP to +63' . $phoneNumber . ": " . $e->getMessage());
            return response()->json([
                'status'=>500,
                'message'=>'Failed to send OTP. '
            ], 500);
        }

        return response()->json([
            'status'=>200,
            'message' => 'OTP has been sent to '. $phoneNumber
        ], 200);
    }

    public function emailSend($email)
    {
        try{
            $otp_gen = otp_generator();
            Cache::put('otp', $otp_gen, 600);
            Mail::to($email)->send(new SendOtpViaMail($otp_gen)); // Iisang variable, kasi pag cinall mo twice, different ang OTP
        }catch(NetworkExceptionInterface $e){
            return response()->json([
                'status'=>503,
                'message'=>'Network error. Please try again later'
            ], 503);
        } catch(\Throwable $th){
            Log::error('Failed to send email to ' . $email . ": " . $th->getMessage());
            return response()->json([
                'status'=>500,
                'message'=>'Failed to send email.'
            ], 500);
        }

        return response()->json([
            'message' => 'OTP has been sent to '. $email
        ]);
    }

    public function verifyCode($otpCode)
    {
        try{
            $inputCode = $otpCode;
            $otp = Cache::get('otp');
        }catch(\Exception $e){
            Log::error('Something went wrong while verification of code: ' . $e->getMessage());
            return response()->json([
                'status'=> 500,
                'message'=>'An error occurred during verification of code.'
            ], 500);
        }

        if ($otp == (int)$inputCode) {
            $status = true;
        } else {
            $status = false;
        }

        return response()->json([
            'status' => $status ? 200 : 400
        ], $status ? 200 : 400);
    }
}
