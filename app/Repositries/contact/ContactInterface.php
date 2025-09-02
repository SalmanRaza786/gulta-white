<?php


namespace App\Repositries\contact;
interface ContactInterface
{
    public function getContactUsList($request);
    public function deleteFaqs($id);
    public function updateOrCreate($request,$id);
    public function getAllFaqs();

    public function deleteContact($id);
    public function updateContactStatus($id,$isRead);


}
