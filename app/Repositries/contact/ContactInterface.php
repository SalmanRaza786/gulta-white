<?php


namespace App\Repositries\contact;
interface ContactInterface
{
    public function getFaqsList($request);
    public function deleteFaqs($id);
    public function updateOrCreate($request,$id);
    public function getAllFaqs();


}
