<?php


namespace App\Repositries\testimonials;
interface TestimonialsInterface
{
    public function getTestimonials($request);
    public function getAllTestimonials($isPublish);
    public function deleteTestimonials($id);

}
