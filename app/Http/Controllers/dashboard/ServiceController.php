<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Service\StoreServiceRequest;
use App\Http\Requests\Dashboard\Service\UpdateServiceRequest;
use App\Models\AdvantageService;
use App\Models\AdvantageUser;
use App\Models\Service;
use App\Models\Tagline;
use App\Models\ThumbnailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Service::where('users_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('pages.dashboard.service.index', compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->all();

        $data['users_id'] = Auth::user()->id;

        // add to service
        $service = Service::create($data);

        // add to advantage service
        foreach($data['advantage-service'] as $key => $value){
            $advantage_service = new AdvantageService;
            $advantage_service->service_id = $service->id;
            $advantage_service->advantage = $value;
            $advantage_service->save();
        }

        // add to advantage user
        foreach($data['advantage-user'] as $key => $value){
            $advantage_user = new AdvantageUser;
            $advantage_user->service_id = $service->id;
            $advantage_user->advantage = $value;
            $advantage_user->save();
        }

        // add to thumbnail service
        if($request->hasfile('thumbnail'))
        {
            foreach($request->file('thumbnail') as $file )
            {
                $path = $file->store(
                    'assets/service/thumbnail', 'public'
                );

                $thumbnail_service = new ThumbnailService;
                $thumbnail_service->service_id = $service['id'];
                $thumbnail_service->thumbnail = $path;
                $thumbnail_service->save();
            }
        }

        // add to tagline
        if(count($data['tagline'])){
            foreach ($data['tagline'] as $key => $value){
                $tagline = new Tagline;
                $tagline->service_id = $service->id;
                $tagline->tagline = $value;
                $tagline->save();
            }
        }

        toast()->success('Save has been success');
        return redirect()->route('member.service.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $advantage_service = AdvantageService::where('service_id',$service['id'])->get();
        $tagline = Tagline::where('service_id', $service['id'])->get();
        $advantage_user = AdvantageUser::where('service_id', $service['id'])->get();
        $service['id']->get();

        return view('pages.dashboard.service.edit', compact('service','advantage_service','tagline','advantage_user','thumbnail_service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->all();

        // update to service
        $service->update($data);

        // update to advantage service
        foreach($data['advantage-services'] as $key => $value){
            $advantage_service = AdvantageService::find($key);
            $advantage_service->advantage = $value;
            $advantage_service->save();
        }

        // add new advantage service
        if(isset($data['advantage-service'])){
            foreach($data['advantage-service'] as $key => $value){
                $advantage_service = New AdvantageService;
                $advantage_service->service_id = $service['id'];
                $advantage_service->advantage = $value;
                $advantage_service->save();
            }
        }

        // update to advantage user

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
