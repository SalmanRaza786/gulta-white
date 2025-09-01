<?php


namespace App\Repositries\contact;
interface ContactInterface
{
    public function getContactUsList($request);
    public function deleteFaqs($id);
    public function updateOrCreate($request,$id);
    public function getAllFaqs();


}
