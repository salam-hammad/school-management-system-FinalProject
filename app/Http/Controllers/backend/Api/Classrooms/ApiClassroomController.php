<?php

namespace App\Http\Controllers\backend\Api\Classrooms;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Classroom;
use App\Http\Controllers\Controller;
use App\Http\Requests\Classrooms\StoreClassrooms;
use App\Http\Requests\Classrooms\UpdateClassrooms;
use App\Http\Requests\Classrooms\DeleteClassrooms;
use App\Http\Requests\Classrooms\DeleteAllClassrooms;
use App\Http\Requests\Classrooms\FilterClassrooms;

class ApiClassroomController extends Controller
{
    /**
     * عرض جميع الفصول الدراسية.
     */
    public function index()
    {
        $My_Classes = Classroom::all();
        $Grades = Grade::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'List of Classrooms and Grades | قائمة الفصول والمراحل الدراسية',
            'data' => [
                'classrooms' => $My_Classes,
                'grades' => $Grades,
            ],
        ]);
    }

    /**
     * إنشاء فصل دراسي جديد.
     */
    public function store(StoreClassrooms $request)
    {
        $List_Classes = $request->List_Classes;
        try {
            $validated = $request->validated();
            $createdClasses = [];

            foreach ($List_Classes as $List_Class) {
                $My_Classes = new Classroom();
                $My_Classes->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];
                $My_Classes->Grade_id = $List_Class['Grade_id'];
                $My_Classes->save();
                $createdClasses[] = $My_Classes;
            }

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Classrooms created successfully | تم إنشاء الفصول الدراسية بنجاح',
                'data' => $createdClasses,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error creating classrooms | حدث خطأ أثناء إنشاء الفصول الدراسية',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * تحديث فصل دراسي محدد.
     */
    public function update(UpdateClassrooms $request, $id)
    {
        try {
            $Classrooms = Classroom::findOrFail($id);
            $Classrooms->update([
                'Name_Class' => ['ar' => $request->Name, 'en' => $request->Name_en],
                'Grade_id' => $request->Grade_id,
            ]);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Classroom updated successfully | تم تحديث الفصل الدراسي بنجاح',
                'data' => $Classrooms,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error updating classroom | حدث خطأ أثناء تحديث الفصل الدراسي',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * حذف فصل دراسي محدد.
     */
    public function destroy(DeleteClassrooms $request, $id)
    {
        try {
            $Classrooms = Classroom::findOrFail($id);
            $Classrooms->delete();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Classroom deleted successfully | تم حذف الفصل الدراسي بنجاح',
                'data' => $Classrooms,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error deleting classroom | حدث خطأ أثناء حذف الفصل الدراسي',
                'error' => $e->getMessage(),
            ]);
        }
    }
    
    /**
     * حذف عدة فصول دراسية.
     */
    public function delete_all(DeleteAllClassrooms $request)
    {
        try {
            $delete_all_id = explode(",", $request->delete_all_id);
            $deletedClassrooms = Classroom::whereIn('id', $delete_all_id)->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Classrooms deleted successfully | تم حذف الفصول الدراسية بنجاح',
                'data' => $deletedClassrooms,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error deleting classrooms | حدث خطأ أثناء حذف الفصول الدراسية',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * تصفية الفصول الدراسية حسب المرحلة.
     */
    public function Filter_Classes(FilterClassrooms $request)
    {
        try {
            $Search = Classroom::where('Grade_id', $request->Grade_id)->get();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Filtered Classrooms | تم تصفية الفصول الدراسية بنجاح',
                'data' => $Search,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error filtering classrooms | حدث خطأ أثناء تصفية الفصول الدراسية',
                'error' => $e->getMessage(),
            ]);
        }
    }
}