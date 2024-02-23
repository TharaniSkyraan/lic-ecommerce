<?php
// src/LicecommerceHelper.php

namespace Tharasky\LicEcommerce\Helpers;

use Illuminate\Support\Facades\Schema;
use Tharasky\LicEcommerce\Models\License;

class LicEcommerceHelper
{
    public static function ensureLicenseActive()
    {
        $tableName = 'licenses'; // Replace with your actual table name
      
        if (!Schema::hasTable($tableName)) { 

            // Run the migration to create the table
            self::runMigration();
        }else{
            $license = License::first();

            if($license==null){
                return '/installlic';
            }else{
                $apiUrl = "https://skyraa-products.skyraan.net/api/validate-license-api";

                $data = array(
                    'license_key' => $license->license_key,
                    'product_key' => $license->product_key,
                    'user_name' => $license->user_name,
                );
    
                // Initialize cURL session
                $ch = curl_init($apiUrl);
    
                // Set cURL options
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
                // Execute cURL session and get the response
                $response = curl_exec($ch);
                
                // Close cURL session
                curl_close($ch);
    
                if($response!='success' && $response!='already_actived')
                {
                    if($response=='expired'){
                        return '/lic-expired';
                    }
                    return '/installlic';
                }   
                return 'success';
            }
        }
    }

    private static function runMigration()
    {
        $migrationPath = __DIR__ . '/database/migrations'; // Adjust the path accordingly

        // Run migration using Artisan command
        \Artisan::call('migrate', [
            '--path' => $migrationPath,
            '--force' => true,
        ]);
    }
}
