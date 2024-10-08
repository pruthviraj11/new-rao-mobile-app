<?php

namespace App\Http\Controllers;
use App\Models\NewsCategory;
use App\Services\HomeServicesService;
use Illuminate\Http\Request;
use App\Http\Requests\HomeService\CreateHomeServiceRequest;
use App\Http\Requests\HomeService\UpdateHomeServiceRequest;
use App\Models\ClientType;
use App\Models\HomeService;
use \Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class HomeServiceController extends Controller
{
    protected $HomeServicesService;

    public function __construct(HomeServicesService $homeServices)
    {
        $this->HomeServicesService = $homeServices;
        $this->middleware('permission:home-services-list|home-services-create|home-services-edit|home-services-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:home-services-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:home-services-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:home-services-delete', ['only' => ['destroy']]);

        // Permission::create(['name' => 'home-services-list', 'guard_name' => 'web', 'module_name' => 'Home Service']);
        // Permission::create(['name' => 'home-services-create', 'guard_name' => 'web', 'module_name' => 'Home Service']);
        // Permission::create(['name' => 'home-services-edit', 'guard_name' => 'web', 'module_name' => 'Home Service']);
        // Permission::create(['name' => 'home-services-delete', 'guard_name' => 'web', 'module_name' => 'Home Service']);

    }
    public function index()
    {
        return view('content/apps/HomeService/list');
    }

    public function create()
    {
        $homeService = "";
        $page_data['page_title'] = "home services Add";
        $page_data['form_title'] = "Add New home services";
        $ClientType = ClientType::where('status', '1')->get();
        return view('/content/apps/HomeService/create-edit', compact('page_data', 'homeService', 'ClientType'));
    }
    public function getAll()
    {
        $homeService = $this->HomeServicesService->getAllHomeService();
        return DataTables::of($homeService)
            ->addColumn('client_type', function ($row) {
                return $row->clientType ? $row->clientType->displayname : 'N/A';
            })
            ->addColumn('actions', function ($row) {
                $encryptedId = encrypt($row->id);
                // Update Button
                $updateButton = "<a class='btn btn-warning btn-sm ' href='" . route('app-home-services-edit', $encryptedId) . "'><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-edit ficon\"><path d=\"M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7\"></path><path d=\"M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z\"></path></svg> </a>";

                // Delete Button
                $deleteButton = "<a class='btn btn-danger btn-sm  confirm-delete' data-idos='$encryptedId' id='confirm-color' href='" . route('app-home-services-delete', $encryptedId) . "'><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-trash-2 ficon\"><polyline points=\"3 6 5 6 21 6\"></polyline><path d=\"M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2\"></path><line x1=\"10\" y1=\"11\" x2=\"10\" y2=\"17\"></line><line x1=\"14\" y1=\"11\" x2=\"14\" y2=\"17\"></line></svg> </a>";
                return $updateButton . " " . $deleteButton;
            })
            ->rawColumns(['actions'])->make(true);


    }
    /**
     * Search slider user data
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHomeServiceRequest $request)
    {
        try {
            $homeServiceData['title'] = $request->get('title');
            $homeServiceData['description'] = $request->get('description');
            $homeServiceData['status'] = $request->get('status') === 'on' ? 1 : 0;
            if ($request->hasFile('file')) {
                $originalName = $request->file('file')->getClientOriginalName();
                $filename = str_replace(' ', '_', $originalName);
                $filePath = $request->file('file')->storeAs('HomeserviceIcons', $filename, 'public');
                $homeServiceData['file'] = $filePath;
            }
            if ($request->hasFile('service_image')) {
                $originalName = $request->file('service_image')->getClientOriginalName();
                $filename = str_replace(' ', '_', $originalName);
                $service_imagePath = $request->file('service_image')->storeAs('HomeserviceImages', $filename, 'public');
                $homeServiceData['service_image'] = $service_imagePath;
            }
            $homeService = $this->HomeServicesService->create($homeServiceData);
            if (!empty($homeService)) {
                return redirect()->route('app-home-services-list')->with('success', 'NewsCategorie Added Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Adding NewsCategorie');
            }
        } catch (\Exception $error) {
            dd($error->getMessage());
            return redirect()->route('app-home-services-list')->with('error', 'Error while editing NewsCategorie');
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $encrypted_id
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypted_id)
    {

        try {
            $id = decrypt($encrypted_id);
            $homeService = $this->HomeServicesService->getHomeService($id);
            $page_data['page_title'] = "home services Edit";
            $page_data['form_title'] = "Edit home services";
            $ClientType = ClientType::where('status', '1')->get();
            return view('content/apps/HomeService/create-edit', compact('page_data', 'homeService', 'ClientType'));
        } catch (\Exception $error) {
            return redirect()->route("app/HomeServices/list")->with('error', 'Error while editing NewsCategories');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $encrypted_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeServiceRequest $request, $encrypted_id)
    {
        try {
            $id = decrypt($encrypted_id);

            $homeService = $this->HomeServicesService->getHomeService($id);
            $homeServiceData['title'] = $request->get('title');
            $homeServiceData['description'] = $request->get('description');
            $homeServiceData['status'] = $request->get('status') === 'on' ? 1 : 0;
            if ($request->hasFile('file')) {
                if ($homeService->file) {
                    Storage::disk('public')->delete($homeService->file);
                }

                $originalName = $request->file('file')->getClientOriginalName();
                $filename = str_replace(' ', '_', $originalName);
                $filePath = $request->file('file')->storeAs('sliders', $filename, 'public');

                $homeServiceData['file'] = $filePath;
            }
            if ($request->hasFile('service_image')) {
                if ($homeService->service_image) {
                    Storage::disk('public')->delete($homeService->service_image);
                }

                $originalName = $request->file('service_image')->getClientOriginalName();
                $filename = str_replace(' ', '_', $originalName);
                $service_imagePath = $request->file('service_image')->storeAs('sliders', $filename, 'public');

                $homeServiceData['service_image'] = $service_imagePath;
            }

            $updated = $this->HomeServicesService->updateHomeService($id, $homeServiceData);
            if (!empty($updated)) {
                return redirect()->route("app-home-services-list")->with('success', 'NewsCategories Updated Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Updating NewsCategories');
            }
        } catch (\Exception $error) {
            return redirect()->route("app-home-services-list")->with('error', 'Error while editing NewsCategories');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $encrypted_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($encrypted_id = '')
    {

        try {
            $id = decrypt($encrypted_id);
            $deleted = $this->HomeServicesService->deleteHomeService($id);
            if (!empty($deleted)) {
                return redirect()->route("app-home-services-list")->with('success', 'NewsCategories Deleted Successfully');
            } else {
                return redirect()->back()->with('error', 'Error while Deleting NewsCategories');
            }
        } catch (\Exception $error) {
            return redirect()->route("app-home-services-list")->with('error', 'Error while editing NewsCategories');
        }
    }



    public function destroyimageServiceIcon($encrypted_id)
    {
        try {
            // Decrypt the ID
            $id = decrypt($encrypted_id);
            $homeService = HomeService::find($id);

            if ($homeService) {
                $homeService->file = '';
                $homeService->save();
                return redirect()->back()->with('success', 'Icon updated successfully');
            } else {
                return redirect()->back()->with('error', 'Home service not found.');
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->back()->with('error', 'Invalid ID.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the image. Please try again.');
        }
    }


    public function destroyimageServiceImage($encrypted_id)
    {
        try {
            // Decrypt the ID
            $id = decrypt($encrypted_id);
            $homeService = HomeService::find($id);

            if ($homeService) {
                $homeService->service_image = '';
                $homeService->save();
                return redirect()->back()->with('success', 'Service image updated successfully');
            } else {
                return redirect()->back()->with('error', 'Home service not found.');
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->back()->with('error', 'Invalid ID.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the image. Please try again.');
        }
    }



}
