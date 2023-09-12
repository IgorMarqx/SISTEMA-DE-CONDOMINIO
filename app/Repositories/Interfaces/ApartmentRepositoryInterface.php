<?php

namespace App\Repositories\Interfaces;

interface ApartmentRepositoryInterface
{
    public function getAll();
    public function storeApartment($data);
    public function findApartmentById($id);
    public function updateApartment($data, $id);
    public function deleteApartment($id);
}
