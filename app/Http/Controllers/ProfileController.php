<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\Calender;
use App\Models\Timeline;
use App\Models\Track;
use App\Models\Admission;
use Illuminate\Http\Request;
use Auth;
use Exception;

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
        $data = Calender::where('user_id', $userId)->orderBy('day', 'desc')->get()->groupBy('day');
        return view('profile.calendar', compact('user', 'data'));
    }

    public function settings(Request $request, $userId) {
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }


    public function location(Request $request, $userId) {
        $user = User::findOrFail($userId);
        return view('profile.location', compact('user'));
    }

    public function following(Request $request, $userId) {
        $user = User::findOrFail($userId);
        $title = "Following";
        $userIds = $user->following->pluck('follows')->toArray();
        $data = User::whereIn('id', $userIds)->get();
        return view('profile.follow', compact('user', 'title', 'data'));
    }

    public function followers(Request $request, $userId) {
        $user = User::findOrFail($userId);
        $title = "Followers";
        $userIds = $user->followers->pluck('user_id')->toArray();
        $data = User::whereIn('id', $userIds)->get();
        return view('profile.follow', compact('user', 'title', 'data'));
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


            if(!empty($request->map)) {
                $bio = [
                    "key"       => "map",
                    "value"     => $request->map,
                    "order"     => "-1",
                    "user_id"   => Auth::user()->id
                ];

                UserDetails::updateOrCreate([
                    "key"       => "map",
                    "user_id"   => Auth::user()->id
                ], $bio);
            }

            
            if(!empty($request->type)) {
                User::where('id', Auth::user()->id)->update([
                    'type' => $request->type
                ]);
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

    public function calenderNew($userId, Request $request) {
        try {

            $validator = \Validator::make($request->all(),[
                "exercise"	=>	"required|min:3",
                "day"	    =>	"required"
            ]);

            if ($validator->fails()) {
                throw new Exception(implode(",",$validator->messages()->all()));
            }

            Calender::create([
                "user_id"   => $userId,
                "day"       => $request->day,
                "exercise"  => $request->exercise
            ]);


            $msg = ["success" => true, "msg"	=>	"New exercise added"];
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

    public function deleteExercise($user_id, $calender_id) {
        try {
            $calender = Calender::where([
                "user_id" => $user_id,
                "id"    =>  $calender_id
            ])->first();

            if (!$calender)
                throw new \Exception("Data not found");

            $calender->delete();
            $msg = ["success" => true, "msg"	=>	"Exercise removed"];
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

    public function today(Request $request) {
        $day = date('l');
        $user = $request->user();
        $exercise = Calender::where('day', date('l'))->get();
        $exercise->map(function ($e) use ($user) {
            $e->done = !empty(Track::where([
                "user_id" => $user->id,
                "calendar_id" => $e->id
            ])->first());
        });
       return view('profile.today', compact('day', 'user', 'exercise'));
    }


    public function doneExercise($user_id, $calender_id) {
        try {
            $calender = Calender::where([
                "user_id" => $user_id,
                "id"    =>  $calender_id
            ])->first();

            if (!$calender)
                throw new \Exception("Data not found");

            Track::create([
                "user_id"       => $user_id,
                "calendar_id"   => $calender_id
            ]);
        } catch (\Exception $e) {
			\Log::info([
				"Error"	=>	$e->getMessage(),
				"File"	=>	$e->getFile(),
				"Line"	=>	$e->getLine()
			]);
            $msg = ["success" => false, "msg"	=>	$e->getMessage()];
            return view('message', compact('msg'));
        }

        return back();
    }

    public function askAdmission($id) {
        $data = Admission::where([ 
        'user_id' => Auth::user()->id,
        'gym_id' => $id
        ])->get();
        $gym = User::findOrFail($id);
        return view('profile.ask-admission', compact('data', 'gym'));
    }

    public function handleAskAdmission(Request $request, $gym_id) {
        try {
            $validator = \Validator::make($request->all(),[
                "message"	=>	"required|min:3",
            ]);

            if ($validator->fails()) {
                throw new Exception(implode(",",$validator->messages()->all()));
            }
            
            Admission::updateOrCreate([
                'gym_id'  => $gym_id,
                'user_id' => Auth::user()->id,
                'message' => $request->message      
            ], [
                'gym_id'  => $gym_id,
                'user_id' => Auth::user()->id,
            ]);
            $msg = ["success" => true, "msg" => "Request for admission sent"];
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
