<?php

namespace App\Http\Controllers\backend\Api\Students\dashboard\Profiles;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Http\Requests\Students\dashboard\Profiles\UpdateProfiles;
use Illuminate\Support\Facades\Hash;

class ApiProfileController extends Controller
{
    // عرض بيانات الملف الشخصي للطالب
    public function show($id)
    {
        $student = Student::find($id);
    
        if (!$student) {
            return response()->json([
                'status_code' => 404,
                'status_message' => 'الملف الشخصي غير موجود',
            ], 404);
        }
    
        return response()->json([
            'status_code' => 200,
            'status_message' => 'بيانات الملف الشخصي',
            'data' => $student,
        ]);
    }

    // تحديث بيانات الملف الشخصي للطالب
    public function update(UpdateProfiles $request, $id)
    {
        try {
            $student = Student::findOrFail($id);
    
            $data = $request->validated();
    
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
    
            $student->update($data);
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'تم تحديث الملف الشخصي بنجاح',
                'data' => $student,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'حدث خطأ أثناء تحديث الملف الشخصي',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}