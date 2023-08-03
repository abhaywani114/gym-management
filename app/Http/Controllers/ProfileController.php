<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function profile(Request $request, $userId) {
        $user = User::findOrFail($userId);
        return view('profile.timeline', compact('user'));
    }

    public function details(Request $request, $userId) {
        $user = User::findOrFail($userId);
        return view('profile.details', compact('user'));
    }

    public function calendar(Request $request, $userId) {
        $user = User::findOrFail($userId);
        return view('profile.calendar', compact('user'));
    }

    public function settings(Request $request, $userId) {
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }

    public function settingsHandle(Request $request) {
        try {

            if(!empty($request->bio)) {
                $bio = [
                    "key"       => "bio",
                    "value"     => $request->bio,
                    "order"     => "-1",
                    "user_id"   => Auth::user()->id
                ];

                UserDetails::updateOrCreate([
                    "key"       => "bio",
                    "user_id"   => Auth::user()->id
                ], $bio);
            }

            if (!empty($file = $this->saveFile('dp'))) {

                $bio = [
                    "key"       => "dp",
                    "value"     => $file,
                    "order"     => "-1",
                    "user_id"   => Auth::user()->id
                ];

                UserDetails::updateOrCreate([
                    "key"       => "dp",
                    "user_id"   => Auth::user()->id
                ], $bio);

            }

            if (!empty($request->password)) {
                $validator = Validator::make($request->all(),[
                    "password"	=>	"required|min:5|confirmed",
                    "oldpassword"	=>	"required",
                ]);

                if ($validator->fails()) {
                    throw new Exception(implode(",",$validator->messages()->all()));
                }

                #Match The Old Password
                if(!Hash::check($request->oldpassword, auth()->user()->password)){
                    throw new Exception("Invalid old password");
                }

                $user_id = Auth::id();
                $user = User::find($user_id);
                $user->password = Hash::make($request->password);
                $user->save();

            }

            $msg = ["success" => true, "msg"	=> "Profile updated successfully"];
        } catch (\Exception $e) {
			\Log::info([
				"Error"	=>	$e->getMessage(),
				"File"	=>	$e->getFile(),
				"Line"	=>	$e->getLine()
			]);
            $msg = ["success" => false, "msg"	=>	$e->getMessage()];
        }
        return view('message', compact('msg'));
    }

    public function saveFile($fieldName) {
        // Check if file was uploaded
        if(request()->hasFile($fieldName)) {

            // Get the file from the request
            $file = request()->file($fieldName);

            // Get the file extension
            $extension = $file->getClientOriginalExtension();

            // Check if the file type is allowed
            if(in_array($extension, ['gif', 'jpg', 'jpeg', 'png', 'pdf', 'svg'])) {

                // Generate a unique name for the file
                $fileName = time().'-'.$file->getClientOriginalName();

                // Save the file to the storage folder
                $path = $file->storeAs('public/files', $fileName);

                // Return the static URL for the file
                return asset(str_replace('public', 'storage', $path));
            }

            // Return null if the file type is not allowed
            return null;
        }

        // Return null if no file was uploaded
        return null;
      }
}
