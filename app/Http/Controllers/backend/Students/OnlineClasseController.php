<?php

namespace App\Http\Controllers\backend\Students;

use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\online_classe;
use Jubaer\Zoom\Facades\Zoom;
use App\Http\Controllers\Controller;
use App\Http\Traits\MeetingZoomTrait;

class OnlineClasseController extends Controller
{
    use MeetingZoomTrait;
    public function index()
    {
        $online_classes = online_classe::where('created_by', auth()->user()->email)->get();
        return view('pages.online_classes.index', compact('online_classes'));
    }
    public function create()
    {
        $Grades = Grade::all();
        $Subjects = Subject::all();
        //  dd($Subjects);
        return view('pages.online_classes.add', compact('Grades', 'Subjects'));
    }
    public function indirectCreate()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.indirect', compact('Grades'));
    }
    public function store(Request $request)

    {
        //dd($request->all());
        try {
            $meeting = $this->createMeeting($request);
            $onlineClass =  online_classe::create([
                'integration' => true,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
            // Attach the subject to the online class in the pivot table
            $onlineClass->subjects()->attach($request->Subject_id);

            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function storeIndirect(Request $request)
    {
        try {
            online_classe::create([
                'integration' => false,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function destroy(Request $request)
    {
        try {
            $info = online_classe::find($request->id);

            if ($info->integration == true) {
                $this->deleteMeeting($request->meeting_id);
            }

            online_classe::destroy($request->id);

            toastr()->success(trans('messages.Delete'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}