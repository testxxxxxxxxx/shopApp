<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PersonalDataUserService;
use App\Http\Requests\IdRequest;
use App\Http\Requests\PersonalDateRequest;
use App\Http\Requests\UserIdRequest;
use App\Models\PersonalDataUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class PersonalDataController extends Controller
{
    public function __construct(private PersonalDataUserService $personalDataUserService)
    {
        $this->personalDataUserService = $personalDataUserService;

    }

    public function index(): View | RedirectResponse
    {
        if(Auth::check())
        {

            return view('index', []);
        }

        return redirect()->back();
    }
    public function show(UserIdRequest $userIdRequest): View | RedirectResponse
    {
        if(Auth::check())
        {
            $userId = (int)$userIdRequest->input('userId');

            $name = $this->personalDataUserService->getName($userId);
            $lastname = $this->personalDataUserService->getLastName($userId);
            $streetName = $this->personalDataUserService->getStreetName($userId);
            $hauseNumber = $this->personalDataUserService->getHauseNumber($userId);
            $zipCode = $this->personalDataUserService->getZipCode($userId);
            $city = $this->personalDataUserService->getCityName($userId);
            $country = $this->personalDataUserService->getCountryName($userId);

            return view('index', ['name' => $name, 'lastname' => $lastname, 'streetName' => $streetName, 'hauseNumber' => $hauseNumber, 'zipCode' => $zipCode, 'city' => $city, 'country' => $country]);
        }

        return redirect()->back();
    }
    public function create(PersonalDateRequest $personalDateRequest, UserIdRequest $userIdRequest): RedirectResponse
    {
        if(Auth::check())
        {
            $name = $personalDateRequest['name'];
            $lastname = $personalDateRequest['lastname'];
            $streetName = $personalDateRequest['streetName'];
            $hauseNumber = $personalDateRequest['hauseNumber'];
            $zipCode = $personalDateRequest['zipCode'];
            $city = $personalDateRequest['city'];
            $country = $personalDateRequest['country'];
            $userId = $userIdRequest->input('userId');

            $personalDataIsCreated = $this->personalDataUserService->create($name, $lastname, $streetName, $hauseNumber, $zipCode, $city, $country, $userId);

            if($personalDataIsCreated)
                return redirect()->route('showPersonalData');

            return redirect()->back();
        }

        return redirect()->back();
    }
    public function update(IdRequest $idRequest, PersonalDataUser $personalDataUser, UserIdRequest $userIdRequest): RedirectResponse
    {
        if(Auth::check())
        {
            $id = $idRequest->input('id');
            $name = $personalDataUser['name'];
            $lastname = $personalDataUser['lastname'];
            $streetName = $personalDataUser['streetName'];
            $hauseNumber = $personalDataUser['hauseNumber'];
            $zipCode = $personalDataUser['zipCode'];
            $city = $personalDataUser['city'];
            $country = $personalDataUser['country'];
            $userId = $userIdRequest['userId'];

            $personalDataIsUpdated = $this->personalDataUserService->update($id, $name, $lastname, $streetName, $hauseNumber, $zipCode, $city, $country, $userId);

            if($personalDataIsUpdated)
            {
                $message = 'Your personal data has been updated!';

                return redirect()->route('showPersonalData', ['id' => $id, 'message' => $message]);
            }

            $error = 'Your personal data has not been updated!';

            return redirect()->route('showPersonalData', ['id' => $id, 'error' => $error]);
        }

        return redirect()->back();
    }

}
