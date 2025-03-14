<?php

namespace App\Http\Controllers\backend\Api\Students\dashboard\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quizze;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Students\dashboard\Exams\StoreExams;
use App\Http\Requests\Students\dashboard\Exams\UpdateExams;

class ApiExamController extends Controller
{
    /**
     * عرض جميع الامتحانات للطالب.
     */
    public function index()
    {
        // ✅ التحقق مما إذا كان المستخدم مسجل الدخول
        if (!Auth::check()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'User is not authenticated | المستخدم غير مصادق عليه',
            ], 401);
        }

        $user = Auth::user();

        $quizzes = Quizze::where('grade_id', $user->Grade_id)
            ->where('classroom_id', $user->Classroom_id)
            ->where('section_id', $user->section_id)
            ->orderBy('id', 'DESC')
            ->get();

        // ✅ التأكد من استرجاع `name` بالترجمة الصحيحة
        $quizzes->transform(function ($quiz) {
            return [
                'id' => $quiz->id,
                'name' => $quiz->getTranslation('name', app()->getLocale()) ?: 'No translation available',
                'subject_id' => $quiz->subject_id,
                'grade_id' => $quiz->grade_id,
                'classroom_id' => $quiz->classroom_id,
                'section_id' => $quiz->section_id,
                'teacher_id' => $quiz->teacher_id,
                'created_at' => $quiz->created_at,
                'updated_at' => $quiz->updated_at,
            ];
        });

        return response()->json([
            'status_code' => 200,
            'status_message' => 'List of Exams | قائمة الامتحانات',
            'data' => $quizzes,
        ]);
    }

    /**
     * عرض امتحان محدد.
     */
    public function show($quizze_id)
    {
        try {
            $quizze = Quizze::findOrFail($quizze_id);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Exam details | تفاصيل الامتحان',
                'data' => [
                    'id' => $quizze->id,
                    'name' => $quizze->getTranslation('name', app()->getLocale()) ?: 'No translation available',
                    'subject_id' => $quizze->subject_id,
                    'grade_id' => $quizze->grade_id,
                    'classroom_id' => $quizze->classroom_id,
                    'section_id' => $quizze->section_id,
                    'teacher_id' => $quizze->teacher_id,
                    'created_at' => $quizze->created_at,
                    'updated_at' => $quizze->updated_at,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 404,
                'status_message' => 'Exam not found | لم يتم العثور على الامتحان',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * إنشاء امتحان جديد.
     */
    public function store(StoreExams $request)
    {
        try {
            $validated = $request->validated();

            // ✅ التأكد من أن `name` يتم حفظه بشكل صحيح كترجمة
            $quizze = new Quizze();
            $quizze->setTranslation('name', app()->getLocale(), $validated['name']);
            $quizze->subject_id = $validated['subject_id'];
            $quizze->grade_id = $validated['grade_id'];
            $quizze->classroom_id = $validated['classroom_id'];
            $quizze->section_id = $validated['section_id'];
            $quizze->teacher_id = $validated['teacher_id'];
            $quizze->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Exam created successfully | تم إنشاء الامتحان بنجاح',
                'data' => $quizze,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error creating exam | حدث خطأ أثناء إنشاء الامتحان',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * تحديث امتحان محدد.
     */
    public function update(UpdateExams $request, $quizze_id)
    {
        try {
            $quizze = Quizze::findOrFail($quizze_id);
            
            // ✅ تحديث `name` بالطريقة الصحيحة
            $quizze->setTranslation('name', app()->getLocale(), $request->input('name'));
            $quizze->update([
                'subject_id' => $request->input('subject_id'),
                'grade_id' => $request->input('grade_id'),
                'classroom_id' => $request->input('classroom_id'),
                'section_id' => $request->input('section_id'),
                'teacher_id' => $request->input('teacher_id'),
            ]);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Exam updated successfully | تم تحديث الامتحان بنجاح',
                'data' => $quizze,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 404,
                'status_message' => 'Exam not found or update failed | لم يتم العثور على الامتحان أو فشل التحديث',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * حذف امتحان محدد.
     */
    public function destroy($quizze_id)
    {
        try {
            $quizze = Quizze::findOrFail($quizze_id);
            $quizze->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Exam deleted successfully | تم حذف الامتحان بنجاح',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 404,
                'status_message' => 'Exam not found or delete failed | لم يتم العثور على الامتحان أو فشل الحذف',
                'error' => $e->getMessage(),
            ], 404);
        }
    }
}
