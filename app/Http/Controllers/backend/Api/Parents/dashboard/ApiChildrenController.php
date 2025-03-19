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
    /**
     * Get the list of children for the authenticated parent.
     */
    public function index()
    {
        // تحقق من أن المستخدم مصادق عليه
        if (!auth('sanctum')->user()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Unauthorized | غير مصرح لك بالوصول إلى هذه البيانات',
            ], 401);
        }
    
        // الحصول على قائمة الأبناء
        $students = Student::where('parent_id', auth('sanctum')->user()->id)->get();
    
        return response()->json([
            'status_code' => 200,
            'status_message' => 'List of children | قائمة الأبناء',
            'data' => $students,
        ]);
    }

    /**
     * Get the results of a specific student.
     */
    public function results($id)
    {
        // Check if the user is authenticated
        if (!auth()->user()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Unauthorized | غير مصرح لك بالوصول إلى هذه البيانات',
            ], 401);
        }

        // Find the student or fail
        $student = Student::findOrFail($id);

        // Check if the student belongs to the authenticated parent
        if ($student->parent_id !== auth()->user()->id) {
            return response()->json([
                'status_code' => 403,
                'status_message' => 'Unauthorized | غير مصرح لك بالوصول إلى هذه البيانات',
            ], 403);
        }

        // Get the student's degrees
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

    /**
     * Get the attendance records for the authenticated parent's children.
     */
    public function attendances()
    {
        // Check if the user is authenticated
        if (!auth()->user()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Unauthorized | غير مصرح لك بالوصول إلى هذه البيانات',
            ], 401);
        }

        // Get the attendance records for the authenticated parent's children
        $students = Student::where('parent_id', auth()->user()->id)->with('attendances')->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'List of attendances | قائمة الحضور',
            'data' => $students,
        ]);
    }

    /**
     * Search for attendance records within a date range.
     */
    public function attendanceSearch(Request $request)
    {
        // Check if the user is authenticated
        if (!auth()->user()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Unauthorized | غير مصرح لك بالوصول إلى هذه البيانات',
            ], 401);
        }

        // Validate the request
        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from',
            'student_id' => 'nullable|exists:students,id',
        ]);

        // Get the attendance records based on the search criteria
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

    /**
     * Get the list of fees for the authenticated parent's children.
     */
    public function fees()
    {
        // Check if the user is authenticated
        if (!auth()->user()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Unauthorized | غير مصرح لك بالوصول إلى هذه البيانات',
            ], 401);
        }

        // Get the list of fees for the authenticated parent's children
        $students_ids = Student::where('parent_id', auth()->user()->id)->pluck('id');
        $fee_invoices = Fee_invoice::whereIn('student_id', $students_ids)->get();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'List of fees | قائمة الفواتير',
            'data' => $fee_invoices,
        ]);
    }

    /**
     * Get the receipts for a specific student.
     */
    public function receiptStudent($id)
    {
        // Check if the user is authenticated
        if (!auth()->user()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Unauthorized | غير مصرح لك بالوصول إلى هذه البيانات',
            ], 401);
        }

        // Find the student or fail
        $student = Student::findOrFail($id);

        // Check if the student belongs to the authenticated parent
        if ($student->parent_id !== auth()->user()->id) {
            return response()->json([
                'status_code' => 403,
                'status_message' => 'Unauthorized | غير مصرح لك بالوصول إلى هذه البيانات',
            ], 403);
        }

        // Get the student's receipts
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

    /**
     * Get the profile of the authenticated parent.
     */
    public function profile()
    {
        // Check if the user is authenticated
        if (!auth()->user()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Unauthorized | غير مصرح لك بالوصول إلى هذه البيانات',
            ], 401);
        }

        // Get the parent's profile
        $information = My_Parent::findOrFail(auth()->user()->id);

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Parent profile | ملف ولي الأمر',
            'data' => $information,
        ]);
    }

    /**
     * Update the profile of the authenticated parent.
     */
    public function updateProfile(Request $request, $id)
    {
        // Check if the user is authenticated
        if (!auth()->user()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Unauthorized | غير مصرح لك بالوصول إلى هذه البيانات',
            ], 401);
        }

        // Find the parent or fail
        $information = My_Parent::findOrFail($id);

        // Update the parent's name
        $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];

        // Update the password if provided
        if (!empty($request->password)) {
            $information->password = Hash::make($request->password);
        }

        // Save the changes
        $information->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Profile updated successfully | تم تحديث الملف الشخصي بنجاح',
            'data' => $information,
        ]);
    }
}
