<?php 

namespace App\Contracts;


interface SpeakerRepositoryInterface {

    public function paginatedData(int $paginateNum);
 

    public function storePonente($request, $image);
 

    public function updatePonente($ponente, $request);
  
    
    public function deletePonente($ponente);
}