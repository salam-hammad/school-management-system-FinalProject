<?php

namespace App\Http\Controllers\backend\Students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\online_classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlineZoomClassesController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        
        $online_classes = online_classe::whereHas('subjects', function($query) use ($student) {
            $query->whereHas('students', function($q) use ($student) {
                $q->where('students.id', $student->id);
            });
        })
        ->orderBy('start_at', 'desc')
        ->get();

        return view('pages.Students.dashboard.online_classes.index', compact('online_classes'));
    }
}