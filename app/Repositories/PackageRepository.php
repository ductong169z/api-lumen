<?php
namespace App\Repositories;

use App\Models\Package;

class PackageRepository implements PackageRepositoryInterface
{
    public function all()
    {
        return Package::all();
    }


    public function create(array $data)
    {
        return Package::create($data);
    }

    public function update(array $data, $id)
    {
        $package = Package::findOrFail($id);
        $package->update($data);
        return $package;
    }

    public function find($id)
    {
        return Package::findOrFail($id);
    }

    public function delete($id)
    {
        $package = Package::findOrFail($id);

        return $package->destroy($id);
    }
   
}