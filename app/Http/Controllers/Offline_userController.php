<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Offline_userController extends Controller
{
    public function offline_device_login(Request $request)
    {
        $phone     = $request->phone;
        $password  = $request->password;
        $device_id = $request->device_id;

        // Check if the phone exists in offline_users
        $offlineUser = DB::table('offline_users')
            ->where('phone', $phone)
            ->first();

        if (! $offlineUser) {
            return response()->json([
                'success' => false,
                'msg'     => 'Phone number not matched',
            ]);
        }

        // Check if password matches
        if ($offlineUser->password !== $password) {
            return response()->json([
                'success' => false,
                'msg'     => 'Incorrect password',
            ]);
        }

        // If the user is logging in for the first time (device_id is null)
        if (empty($offlineUser->device_id)) {
            DB::table('offline_users')
                ->where('phone', $phone)
                ->update(['device_id' => $device_id]);

            return response()->json([
                'success' => true,
                'msg'     => 'Login successful - Device registered',
                'data'    => [
                    'phone'     => $phone,
                    'device_id' => $device_id,
                ],
            ]);
        } else {
            // If device_id is already set, update it with the new device_id
            DB::table('offline_users')
                ->where('phone', $phone)
                ->update(['device_id' => $device_id]);

            return response()->json([
                'success' => true,
                'msg'     => 'Login successful - Device updated',
                'data'    => [
                    'offline_user_id' => $offlineUser->offline_user_id,
                    'phone'     => $phone,
                    'device_id' => $device_id,
                ],
            ]);
        }
    }

}
