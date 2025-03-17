<?php

namespace App\Http\Controllers\backend\Api\Parents\dashboard;

use App\Models\Student;
use App\Models\Degree;
use App\Models\Attendance;
use App\Models\Fee_invoice;
use App\Models\ReceiptStudent;
use App\Models\My_Parent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ApiChildrenController extends Controller
{
    public function index()
    {
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'List of children | قائمة الأبناء',
            'data' => $students,
        ]);
    }

    public function results($id)
    {
        $student = Student::findOrFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            return response()->json([
                'status_code' => 403,
                'status_message' => 'Unauthorized | غير مصرح لك بالوصول إلى هذه البيانات',
            ], 403);
        }

        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            return response()->json([
                'status_code' => 404,
                'status_message' => 'No results found for this student | لا توجد نتائج لهذا الطالب',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Student results | نتائج الطالب',
            'data' => $degrees,
        ]);
    }

    public function attendances()
    {
        $students = Student::where('parent_id', auth()->user()->id)->with('attendances')->get();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'List of attendances | قائمة الحضور',
            'data' => $students,
        ]);
    }

    public function attendanceSearch(Request $request)
    {
        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from',
            'student_id' => 'nullable|exists:students,id',
        ]);

        if ($request->student_id == 0) {
            $attendances = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
        } else {
            $attendances = Attendance::where('student_id', $request->student_id)
                ->whereBetween('attendence_date', [$request->from, $request->to])
                ->get();
        }

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Attendance search results | نتائج البحث عن الحضور',
            'data' => $attendances,
        ]);
    }

    public function fees()
    {
        $students_ids = Student::where('parent_id', auth()->user()->id)->pluck('id');
        $fee_invoices = Fee_invoice::whereIn('student_id', $students_ids)->get();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'List of fees | قائمة الفواتير',
            'data' => $fee_invoices,
        ]);
    }

    public function receiptStudent($id)
    {
        $student = Student::findOrFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            return response()->json([
                'status_code' => 403,
                'status_message' => 'Unauthorized | غير مصرح لك بالوصول إلى هذه البيانات',
            ], 403);
        }

        $receipt_students = ReceiptStudent::where('student_id', $id)->get();

        if ($receipt_students->isEmpty()) {
            return response()->json([
                'status_code' => 404,
                'status_message' => 'No receipts found for this student | لا توجد مدفوعات لهذا الطالب',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Student receipts | مدفوعات الطالب',
            'data' => $receipt_students,
        ]);
    }

    public function profile()
    {
        $information = My_Parent::findOrFail(auth()->user()->id);
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Parent profile | ملف ولي الأمر',
            'data' => $information,
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        $information = My_Parent::findOrFail($id);

        $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];

        if (!empty($request->password)) {
            $information->password = Hash::make($request->password);
        }

        $information->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Profile updated successfully | تم تحديث الملف الشخصي بنجاح',
            'data' => $information,
        ]);
    }
}