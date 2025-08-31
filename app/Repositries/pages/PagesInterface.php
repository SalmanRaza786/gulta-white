<?php


namespace App\Repositries\pages;
interface PagesInterface
{
    public function getPagesList($request);
    public function deletePage($id);
    public function findPageById($id);
    public function updateOrCreatePage($request,$id);
    public function findPageByType($pageType);



}
