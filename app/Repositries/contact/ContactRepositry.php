<?php

namespace App\Repositries\contact;

use App\Http\Helpers\Helper;
use App\Models\ContactUs;
use App\Models\Faq;
use App\Models\Role as CustomRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use DataTables;



class ContactRepositry implements ContactInterface
{
    public function updateOrCreate($request,$id)
    {

        try {

             $request->all();
            $role = ContactUs::updateOrCreate(
                [
                    'id' => 0
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'subject' => $request->phone,
                    'message' => $request->message,
                ]
            );
            return Helper::success($role, 'Thank you for reaching out to us. Your message has been received, and our team will get back to you shortly.');
        } catch (\Exception $e) {
            DB::rollBack();
            return Helper::errorWithData($e->getMessage(),[]);
        }
    }


    public function getContactUsList($request)
    {
        try {
            $data['totalRecords'] = ContactUs::count();
            $qry= ContactUs::query();


            $qry=$qry->when($request->s_name, function ($query, $name) {
                return $query->where('questions', 'LIKE', "%{$name}%");
            });


            $qry=$qry->when($request->start, fn($q)=>$q->offset($request->start));
            $qry=$qry->when($request->length, fn($q)=>$q->limit($request->length));
            $data['data'] =$qry->orderByDesc('id')->get();


            return Helper::success($data, $message="Record found");

        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }
    public function deleteFaqs($id)
    {
        try {
            $role = Faq::find($id);
            $role->delete();
            return Helper::success($role, $message=__('translation.record_deleted'));
        } catch (ValidationException $validationException) {
            DB::rollBack();
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        }

    }

    public function getAllFaqs()
    {
        try {

            $qry= Faq::query();
            $data =$qry->orderByDesc('id')->get();
            return Helper::success($data, $message="Record found");

        }catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }

}
