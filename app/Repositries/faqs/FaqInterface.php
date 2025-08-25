<?php


namespace App\Repositries\faqs;
interface FaqInterface
{
    public function getFaqsList($request);
    public function deleteFaqs($id);
    public function updateOrCreate($request,$id);
    public function getAllFaqs();


}
