<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\PersonalDataUser;
use Illuminate\Database\Eloquent\Model;

class PersonalDataUserService
{
    public function getName(int $userId): string
    {
        $name = PersonalDataUser::query()->where('user_id', $userId)->get('name');

        return $name[0]['name'];
    }
    public function getLastName(int $userId): string
    {
        $lastName = PersonalDataUser::query()->where('user_id', $userId)->get('lastname');

        return $lastName[0]['lastname'];
    }
    public function getStreetName(int $userId): string
    {
        $streetName = PersonalDataUser::query()->where('user_id', $userId)->get('street_name');

        return $streetName[0]['street_name'];
    }
    public function getHauseNumber(int $userId): string
    {
        $hauseNumber = PersonalDataUser::query()->where('user_id', $userId)->get('hause_number');

        return $hauseNumber[0]['hause_number'];
    }
    public function getZipCode(int $userId): string 
    {
        $zipCode = PersonalDataUser::query()->where('user_id', $userId)->get('zip_code');

        return $zipCode[0]['zip_code'];
    }
    public function getCityName(int $userId): string
    {
        $cityName = PersonalDataUser::query()->where('user_id', $userId)->get('city');

        return $cityName[0]['city'];
    }
    public function getCountryName(int $userId): string
    {
        $countryName = PersonalDataUser::query()->where('user_id', $userId)->get('country');

        return $countryName[0]['country'];
    }
    public function create(string $name, string $lastName, string $streetName, string $hauseNumber, string $zipCode, string $cityName, string $countryName, int $userId): Model
    {
        $personalDataIsCreated = PersonalDataUser::query()->create([

            'name' => $name,
            'lastname' => $lastName,
            'street_name' => $streetName,
            'hauseNumber' => $hauseNumber,
            'zip_code' => $zipCode,
            'city' => $cityName,
            'country' => $countryName,
            'user_id' => $userId,

        ]);

        return $personalDataIsCreated;
    }
    public function update(int $id, string $name, string $lastName, string $streetName, string $hauseNumber, string $zipCode, string $cityName, string $countryName, int $userId): int
    {
        $personalDataIsUpdated = PersonalDataUser::query()->where('id', $id)->update(['name' => $name, 'lastname' => $lastName, 'street_name' => $streetName,'hause_number' => $hauseNumber, 'zip_code' => $zipCode, 'city' => $cityName, 'country' => $countryName, 'user_id' => $userId]);

        return $personalDataIsUpdated;
    }
    public function delete(int $id): int
    {
        $personalDataIsDeleted = PersonalDataUser::query()->where('id', $id)->delete();

        return $personalDataIsDeleted;
    }

}