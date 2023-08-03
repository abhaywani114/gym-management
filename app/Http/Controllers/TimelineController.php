<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timeline;

class TimelineController extends Controller
{
    public function newPost(Request $request) {
        try {

            $validator = \Validator::make($request->all(),[
                "text"	=>	"required|min:5",
            ]);

            if ($validator->fails()) {
                throw new Exception(implode(",",$validator->messages()->all()));
            }

            Timeline::create([
                "text"      => $request->text,
                "image"     => $this->saveFile('image'),
                "user_id"   => $request->user()->id
            ]);

            $msg = ["success" => true, "msg"	=> "Post added successfully"];
		} catch (Exception $e) {
			Log::info([
				"Error"	=>	$e->getMessage(),
				"File"	=>	$e->getFile(),
				"Line"	=>	$e->getLine()
			]);
            abort(404);
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
