<?php


namespace App\Repositries\generator;
interface GeneratorInterface
{
    public function getProducts($request);
    public function getPCodes($request);
    public function getAllProducts();
    public function deleteProduct($id);
    public function findProductById($id);
    public function updateOrCreate($request,$id);
    public function createPCodes($request);
    public function attemptCodeList($request);
    public function getAllCodes($request);
    public function getAllCodesWithBatchNo($batch);

    public function getMessageList($request);
    public function findTextMessageById($id);

    public function createTextMessage($request);



}
