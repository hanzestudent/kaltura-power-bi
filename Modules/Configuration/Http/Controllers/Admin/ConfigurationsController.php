<?php

namespace Modules\Configuration\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Configuration\Entities\Configuration;

class ConfigurationsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $configurations = Configuration::where('value', 'LIKE', "%$keyword%")
                ->orWhere('path', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $configurations = Configuration::paginate($perPage);
        }

        return view('configuration::admin.index', compact('configurations'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('configuration::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'path' => 'required',
                'value' => 'required'
            ]
        );

        Configuration::create($request->all());

        return redirect('admin/configurations')->with('flash_message', 'Configuration added!');
    }

    /**
     * Show the specified resource.
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $configuration = Configuration::findOrFail($id);

        return view('configuration::admin.show', compact('configuration'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        $configuration = Configuration::findOrFail($id);

        return view('configuration::admin.edit', compact('configuration'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'path' => 'required',
                'value' => 'required'
            ]
        );

        $configuration = Configuration::findOrFail($id);
        $configuration->update($request->all());

        return redirect('admin/configurations')->with('flash_message', 'Configuration updated!');
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return Response
     */
    public function destroy($id)
    {
        Configuration::destroy($id);

        return redirect('admin/configurations')->with('flash_message', 'Configuration deleted!');
    }
}
