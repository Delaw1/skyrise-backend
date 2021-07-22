<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Developer;
use App\General_Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon;
use App\User;
use App\Newsletter;
// use Thumbnail;

class ProjectController extends Controller
{
    public function addProject(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'type_id' => ['required']
        ]);

        if ($validation->fails()) {
            $data = json_decode($validation->errors(), true);

            // $data = ['status' => 'failure']  + $data;

            return response()->json(['message' => $validation->errors()->first()], 400);
        }
        $project = Project::create($request->all());
        if ($project) {
            return response()->json($project, 201);
        }
        return response()->json(['error' => 'Network error'], 400);
    }

    public function editProject(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'type_id' => ['required'],
            'id' => ['required'],
        ]);

        if ($validation->fails()) {
            $data = json_decode($validation->errors(), true);

            // $data = ['status' => 'failure']  + $data;

            return response()->json(['message' => $validation->errors()->first()], 400);
        }
        $project = Project::where('id', $request->id)->update($request->all());
        if ($project) {
            return response()->json($project, 200);
        }
        return response()->json(['error' => 'Network error'], 400);
    }

    public function addDeveloper(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ]);

        if ($validation->fails()) {
            $data = json_decode($validation->errors(), true);

            // $data = ['status' => 'failure']  + $data;

            return response()->json(['message' => $validation->errors()->first()], 400);
        }
        $project = Developer::create($request->all());
        if ($project) {
            return response()->json($project, 201);
        }
        return response()->json(['error' => 'Network error'], 400);
    }

    public function editDeveloper(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'id' => ['required']
        ]);

        if ($validation->fails()) {
            $data = json_decode($validation->errors(), true);

            // $data = ['status' => 'failure']  + $data;

            return response()->json(['message' => $validation->errors()->first()], 400);
        }
        // $project = Developer::where('id', $request->id)->update($request->all());
        $project = Developer::find($request->id);
        $project['name'] = $request->name;
        $project['address'] = $request->address;
        $project['city'] = $request->city;
        $project['province'] = $request->province;
        $project['postal_code'] = $request->postal_code;
        $project['website'] = $request->website;
        $project['contact_firstname'] = $request->contact_firstname;
        $project['contact_lastname'] = $request->contact_lastname;
        $project['contact_phone'] = $request->contact_phone;
        $project['contact_email'] = $request->contact_email;
        $project['country'] = $request->country;
        $project['unit'] = $request->unit;
        $project->save();
        if ($project) {
            return response()->json($project, 200);
        }
        return response()->json(['error' => 'Network error'], 400);
    }

    public function deleteDeveloper(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id' => ['required']
        ]);

        if ($validation->fails()) {
            $data = json_decode($validation->errors(), true);

            // $data = ['status' => 'failure']  + $data;

            return response()->json(['message' => $validation->errors()->first()], 400);
        }
        $project = Developer::where('id', $request->id)->delete();

        if ($project) {
            return response()->json(['msg' => 'Success'], 200);
        }
        return response()->json(['error' => 'Network error'], 400);
    }

    public function getProject(Request $request)
    {
        $projects = Project::latest()->get();
        if ($projects) {
            foreach ($projects as $project) {
                $project->developer;
            }
            return response()->json($projects, 200);
        }
        return response()->json(['error' => 'Network error'], 400);
    }

    public function getAttProject(Request $request)
    {
        $project = Project::where('type_id', 1)->get();
        if ($project) {
            return response()->json($project, 200);
        }
        return response()->json(['error' => 'Network error'], 400);
    }

    public function getDetProject(Request $request)
    {
        $project = Project::where('type_id', 2)->get();
        if ($project) {
            return response()->json($project, 200);
        }
        return response()->json(['error' => 'Network error'], 400);
    }

    public function getDevelopers(Request $request)
    {
        $developers = Developer::orderBy('name')->get();
        if ($developers) {
            foreach ($developers as $developer) {
                $developer->project;
            }
            return response()->json($developers, 200);
        }
        return response()->json(['error' => 'Network error'], 400);
    }

    public function saveGS(Request $request)
    {
        $gs = General_Setting::first();
        $update = $gs->update($request->all());
        if ($update) {
            return response()->json($gs, 200);
        }
        return response()->json(['error' => 'Network error'], 400);
    }

    public function getGS(Request $request)
    {
        $gs = General_Setting::first();
        if ($gs) {
            return response()->json($gs, 200);
        }
        return response()->json(['error' => 'Network error'], 400);
    }

    public function uploadVideo(Request $request)
    {
        $name_videos = array();
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $name_video = time() . mt_rand(1, 9999) . '.' . $video->getClientOriginalExtension();
            $destinationPathV = base_path('public/uploads/videos');
            $upload_status = $video->move($destinationPathV, $name_video);
            $path =  '/uploads/videos/' . $name_video;
            return response()->json(['status' => 'success', 'path' => $path]);
        }

        return 'No video file';
    }

    public function uploadMedia(Request $request)
    {
        // return base_path('public/uploads');
        // $validator = Validator::make($request->all(), [
        //     'media.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:20480',
        // ]);

        // //return errors if any
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 422);
        // }

        $names = array();
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $media) {
                $name = 'images' . time() . mt_rand(1, 9999) . '.' . $media->getClientOriginalExtension();
                $destinationPath = base_path('public/uploads/images');
                $media->move($destinationPath, $name);

                array_push($names, $name);
            }
        }

        // $name_videos = array();
        // if ($request->hasFile('video')) {
        //     foreach ($request->file('video') as $video) {
        //         $name_video = time() . mt_rand(1, 9999) . '.' . $video->getClientOriginalExtension();
        //         $destinationPathV = base_path('public/uploads/videos');
        //         $video->move($destinationPathV, $name_video);

        //         array_push($name_videos, $name_video);
        //     }
        // }

        $name_floor_media = array();
        if ($request->hasFile('floor_media')) {
            foreach ($request->file('floor_media') as $floor) {
                $name_floor_m = 'floor_media' . time() . mt_rand(1, 9999) . '.' . $floor->getClientOriginalExtension();
                $destinationPathF = base_path('public/uploads/floor_media');
                $floor->move($destinationPathF, $name_floor_m);

                array_push($name_floor_media, $name_floor_m);
            }
        }

        $name_floor_sheet = array();
        if ($request->hasFile('floor_sheet')) {
            foreach ($request->file('floor_sheet') as $floor) {
                $name_floor_s = 'floor_sheet' . time() . mt_rand(1, 9999) . '.' . $floor->getClientOriginalExtension();
                $destinationPathF = base_path('public/uploads/floor_sheet');
                $floor->move($destinationPathF, $name_floor_s);

                array_push($name_floor_sheet, $name_floor_s);
            }
        }

        $documents = array();
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $docs) {
                $doc = 'documents' . time() . mt_rand(1, 9999) . '.' . $docs->getClientOriginalExtension();
                $destinationPathF = base_path('public/uploads/documents');
                $docs->move($destinationPathF, $doc);

                array_push($documents, $doc);
            }
        }

        // $sheet = array();
        // if ($request->hasFile('sheet')) {
        //     $sheet_file = $request->file('sheet');
        //     $name_sheet = 'amenities_sheet' . time() . mt_rand(1, 9999) . '.' . $sheet_file->getClientOriginalExtension();
        //     $destinationPathS = base_path('public/uploads/sheets');
        //     $sheet_file->move($destinationPathS, $name_sheet);
        //     array_push($sheet, $name_sheet);
        // }

        return response()->json(['success' => ["message" => "Media uploaded successfuly", "media_path" => $names, "floor_media" => $name_floor_media, "floor_sheet" => $name_floor_sheet, "documents" => $documents]], 200);
    }

    public function deleteProject($id)
    {
        Project::where('id', $id)->delete();
        return response()->json(['id' => $id], 200);
    }

    public function address($value)
    {
        $url = 'https://maps.googleapis.com/maps/api/place/autocomplete/json?input=' . $value . '&types=geocode&language=en&key=AIzaSyAOjwrWcelQApQWmxtL-A5zSONErEdk0i0';
        $headers = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = json_decode(curl_exec($ch));
        curl_close($ch);

        // $output =  curl_exec($ch);
        // curl_close ($ch);
        // $server_output = json_decode($output);

        return response()->json($server_output);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            // return response()->json(['status' => $request->password, 'message' => $user->password]);
            if (Hash::check($request->password, $user->password)) {
                return response()->json(['status' => 'success', 'message' => 'Login succesful']);
            }
        }
        return response()->json(['status' => 'failure', 'message' => 'Invalid Credentials']);
    }

    public function changePassword(Request $request)
    {
        $user = User::first();
        if ($user) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return response()->json(['status' => 'success', 'message' => 'Password changed successfully']);
            }
        }
        return response()->json(['status' => 'failure', 'message' => 'Old password invalid']);
    }

    public function changeUsername(Request $request)
    {
        $user = User::first();
        if ($user) {
            $user->email = $request->email;
            $user->save();
            return response()->json(['status' => 'success', 'message' => 'Username changed successfully']);
        }
        return response()->json(['status' => 'failure', 'message' => 'Try again']);
    }

    public function contact(Request $request)
    {
        $to = 'info@skyriseprojects.com';
        $subject = "New contact email from skyriseprojects.com";
        $msg = "
        <strong>First name: </strong> ".$request->first_name."
        <strong>Last name: </strong> ".$request->last_name."
        <strong>Email: </strong> ".$request->email."
        <strong>Phone: </strong> ".$request->phone."
        <strong>Message: </strong> <em>".$request->message."</em>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        if (mail($to, $subject, $msg, $headers)) {
            return 'sent';
        }
        return 'Not sent';
    }

    public function joinNewsletter(Request $request) {
        $validation = Validator::make($request->all(), [
            'email' => ['required', 'unique:newsletters']
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'failure', 'message' => $validation->errors()->first()], 400);
        }

        $news = Newsletter::create($request->all());
        if($news) {
            return response()->json(['status' => 'success'], 201);
        }
        return response()->json(['status' => 'failure', 'message' => 'Network Error'], 201);
    }

    public function getNewsletter() {
        $news = Newsletter::all();
        if($news) {
            return response()->json(['status' => 'success', 'newsletter' => $news], 200);
        }
        return response()->json(['status' => 'failure', 'message' => 'Network Error'], 201);
    }
}
