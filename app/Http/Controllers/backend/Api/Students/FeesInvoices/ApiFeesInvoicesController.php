<?php

namespace App\Http\Controllers\backend\Api\Students\FeesInvoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fee_invoice;
use App\Http\Requests\Students\Fees\StoreFees;
use App\Http\Requests\Students\Fees\UpdateFees;
use App\Http\Requests\Students\Fees\DeleteFees;
class ApiFeesInvoicesController extends Controller
{
    /**
     * عرض جميع فواتير الرسوم مع التصفح.
     */
    public function index()
    {
        $feesInvoices = Fee_invoice::with(['grade', 'classroom', 'section', 'student', 'fees'])->paginate(10);
        return response()->json([
            'status_code' => 200,
            'status_message' => 'List of Fees Invoices | قائمة فواتير الرسوم',
            'data' => $feesInvoices,
        ]);
    }

    /**
     * إنشاء فاتورة رسوم جديدة.
     */
    public function store(StoreFees $request)
    {
        try {
            // التحقق من البيانات المرسلة
            $validatedData = $request->validated();
    
            // تحقق إضافي لوجود student_id
            if (!isset($validatedData['student_id'])) {
                return response()->json([
                    'status_code' => 400,
                    'status_message' => 'Student ID is required | يجب تحديد الطالب',
                ], 400);
            }
    
            // إنشاء فاتورة جديدة
            $feeInvoice = Fee_invoice::create([
                'title' => ['en' => $validatedData['title']['en'], 'ar' => $validatedData['title']['ar']],
                'amount' => $validatedData['amount'],
                'Grade_id' => $validatedData['Grade_id'],
                'Classroom_id' => $validatedData['Classroom_id'],
                'year' => $validatedData['year'],
                'description' => $validatedData['description'],
                'Fee_type' => $validatedData['Fee_type'],
                'student_id' => $validatedData['student_id'],
                'fee_id' => $validatedData['fee_id'],
                'invoice_date' => now(),
            ]);
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Fee invoice created successfully',
                'data' => $feeInvoice
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error creating fee invoice | حدث خطأ أثناء إنشاء فاتورة الرسوم',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * عرض فاتورة رسوم محددة.
     */
    public function show(string $id)
    {
        $feeInvoice = Fee_invoice::with(['grade', 'classroom', 'section', 'student', 'fees'])->find($id);
        if (!$feeInvoice) {
            return response()->json([
                'status_code' => 404,
                'status_message' => 'Fee Invoice not found | لم يتم العثور على فاتورة الرسوم',
            ]);
        }

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Fee Invoice details | تفاصيل فاتورة الرسوم',
            'data' => $feeInvoice,
        ]);
    }

    /**
     * تحديث فاتورة رسوم محددة.
     */
    public function update(UpdateFees $request, string $id)
    {
        try {
            $feeInvoice = Fee_invoice::find($id);
            if (!$feeInvoice) {
                return response()->json([
                    'status_code' => 404,
                    'status_message' => 'Fee Invoice not found | لم يتم العثور على فاتورة الرسوم',
                ]);
            }

            $feeInvoice->update([
                'title' => ['en' => $request->title['en'], 'ar' => $request->title['ar']],
                'amount' => $request->amount,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'year' => $request->year,
                'description' => $request->description,
                'Fee_type' => $request->Fee_type,
                'student_id' => $request->student_id,
                'fee_id' => $request->fee_id,
                'section_id' => $request->section_id,
            ]);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Fee Invoice updated successfully | تم تحديث فاتورة الرسوم بنجاح',
                'data' => $feeInvoice,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error updating fee invoice | حدث خطأ أثناء تحديث فاتورة الرسوم',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * حذف فاتورة رسوم محددة.
     */
    public function destroy(DeleteFees $request, string $id)
    {
        try {
            $feeInvoice = Fee_invoice::find($id);
            if (!$feeInvoice) {
                return response()->json([
                    'status_code' => 404,
                    'status_message' => 'Fee Invoice not found | لم يتم العثور على فاتورة الرسوم',
                ]);
            }

            $feeInvoice->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Fee Invoice deleted successfully | تم حذف فاتورة الرسوم بنجاح',
                'data' => $feeInvoice,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Error deleting fee invoice | حدث خطأ أثناء حذف فاتورة الرسوم',
                'error' => $e->getMessage(),
            ]);
        }
    }
}