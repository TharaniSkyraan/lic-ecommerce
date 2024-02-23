<?php

namespace Tharasky\LicEcommerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tharasky\LicEcommerce\Models\License;

class LicEcommerceController extends Controller
{

    public function index()
    {
        return view('lic-ecommerce::installation');
    }

    public function store(Request $request){
      
        $rules = [
            'license_key' => 'required',
            'product_key' => 'required',
            'user_name' => 'required',
        ];
        $messages = [
            'license_key.required' => 'The license key is required.',
            'product_key.required' => 'The product key is required.',
            'user_name.required' => 'The user name is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->messages()->messages();
            return response()->json(['errors'=>$errors], 422);
        }else{
            $apiUrl = "https://skyraa-products.skyraan.net/api/validate-license-api";

            $data = array(
                'license_key' => $request->license_key,
                'product_key' => $request->product_key,
                'user_name' => $request->user_name,
            );

            // Initialize cURL session
            $ch = curl_init($apiUrl);

            // // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    
            // // Execute cURL session and get the response
            $response = curl_exec($ch);

            // dd($response);
            // // Close cURL session
            curl_close($ch);

            if($response=='success'){
                
                $apiUrl = "https://skyraa-products.skyraan.net/api/actived-license-api";

                // Initialize cURL session
                $ch = curl_init($apiUrl);
    
                // // Set cURL options
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                // // Execute cURL session and get the response
                $response = curl_exec($ch);
    
                // // Close cURL session
                curl_close($ch);

                License::insert($request->all());

                return response()->json(['success'=>true]);
            }
            if($response=='invalid_product_key'){
                $errors['product_key'][0] = 'Product key is invalid. Try again.';
                return response()->json(['errors'=>$errors], 422);
            }
            if($response=='invalid_user_name'){ 
                $errors['user_name'][0] = 'User name is invalid. Try again.';
                return response()->json(['errors'=>$errors], 422);
            }
            if($response=='expired'){
                $errors['license_key'][0] = 'License key is exipred';
                return response()->json(['errors'=>$errors], 422);
            }
            if($response=='already_actived'){
                $errors['license_key'][0] = 'License key is already activated';
                return response()->json(['errors'=>$errors], 422);
            }
            $errors['license_key'][0] = 'License key is invalid. Try again.';
            return response()->json(['errors'=>$errors], 422);
        }

    }
    
    public function expired()
    {
        return view('lic-ecommerce::expired');
    }

}