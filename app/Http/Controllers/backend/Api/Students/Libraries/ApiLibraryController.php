<?php

namespace App\Http\Controllers\backend\Api\Students\Libraries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Students\Libraries\StoreLibraries;
use App\Http\Requests\Students\Libraries\UpdateLibraries;
use App\Models\Library;
use App\Repository\LibraryRepositoryInterface;

class ApiLibraryController extends Controller
{
    protected $library;

    public function __construct(LibraryRepositoryInterface $library)
    {
        $this->library = $library;
    }

    /**
     * عرض جميع الكتب في المكتبة.
     */
    public function index()
    {
        $books = Library::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'List of Books | قائمة الكتب',
            'data' => $books,
        ]);
    }

    /**
     * إنشاء كتاب جديد في المكتبة.
     */
    public function store(StoreLibraries $request)
    {
        try {
            if ($request->hasFile('file_name')) {
                $file = $request->file('file_name');
                $filePath = $file->store('library_files', 'public'); // حفظ الملف في مجلد storage/app/public/library_files
            } else {
                return response()->json([
                    'status_code' => 400,
                    'status_message' => 'File is required',
                ], 400);
            }
    
            $book = $this->library->store([
                'title' => $request->title,
                'file_name' => $filePath, // حفظ المسار بدلاً من النص
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
            ]);
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Book created successfully',
                'data' => $book,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error creating book',
                'error' => $e->getMessage(),
            ]);
        }
    }
    

    /**
     * تحديث كتاب محدد في المكتبة.
     */
    public function update(UpdateLibraries $request, $id)
    {
        try {
            $book = $this->library->update($request);
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Book updated successfully | تم تحديث الكتاب بنجاح',
                'data' => $book,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error updating book | حدث خطأ أثناء تحديث الكتاب',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * حذف كتاب محدد من المكتبة.
     */
    public function destroy($id)
    {
        try {
            $this->library->destroy($id);
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Book deleted successfully | تم حذف الكتاب بنجاح',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error deleting book | حدث خطأ أثناء حذف الكتاب',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * تحميل مرفق الكتاب.
     */
    public function downloadAttachment($filename)
    {
        try {
            return $this->library->download($filename);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error downloading attachment | حدث خطأ أثناء تحميل المرفق',
                'error' => $e->getMessage(),
            ]);
        }
    }
}