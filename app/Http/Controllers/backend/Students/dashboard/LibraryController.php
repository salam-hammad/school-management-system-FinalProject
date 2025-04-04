<?php

namespace App\Http\Controllers\backend\Students\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Library;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function index()
    {
        try {
            $student = Student::findOrFail(Auth::user()->id);
            $subjects = $student->subjects;
            $books = [];
            foreach ($subjects as $subject) {
                $subjectBooks = Library::where('subject_id', $subject->id)
                    ->where('grade_id', $student->Grade_id)
                    ->where('classroom_id', $student->Classroom_id)
                    ->where('section_id', $student->section_id)
                    ->orderBy('id', 'DESC')
                    ->get();
                foreach ($subjectBooks as $book) {
                    $book->subject_name = $subject->getTranslation('name', 'ar'); 
                    $books[] = $book;
                }
            }

            return view('pages.Students.dashboard.library.index', compact('books'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء جلب البيانات: ' . $e->getMessage());
        }
    }

    public function download($filename)
    {
        try {
            $filePath = public_path('attachments/library/' . $filename);
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'الملف المطلوب غير موجود.');
            }

            return response()->download($filePath);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحميل الملف: ' . $e->getMessage());
        }
    }

    public function downloaded()
    {
        try {
            $student = Student::findOrFail(Auth::user()->id);
            $downloadedBooks = [];
            return view('pages.Students.dashboard.library.downloaded', compact('downloadedBooks'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء جلب البيانات: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->input('query');
            $searchResults = Library::where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orderBy('id', 'DESC')
                ->get();
            return view('pages.Students.dashboard.library.search', compact('searchResults', 'query'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء البحث: ' . $e->getMessage());
        }
    }
}