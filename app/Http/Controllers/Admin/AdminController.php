<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminApp $admin_app)
    {
    $models = $admin_app->get_models_name();

    return view('admin.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AdminApp $admin_app, $id)
    {
        $data = $admin_app->build_form($id);
        $table = strtolower($id).'s';
        return view('admin.create', ['data' => $data, 'table' => $table]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $table)
    {
        $model = substr(ucwords($table),0,-1);
        $model =  'App\Models'.'\\'.$model;
        $object = new $model;
        $fields  = $request->input();
        //dd($fields);
        foreach ($fields as $key => $value) {
           if ($object->isFillable($key)) {
             $object->$key = $value;
           }
        }
        return $object->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AdminApp $admin_app,$id)
    {
        $model = 'App\Models'.'\\'.$id;
        $data = $model::all();
        $fields = $admin_app->get_fields(strtolower($id).'s');
        return view('admin.show', ['data' => $data, 'fields' => $fields, 'model' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($model, $id)
    {
        $model = 'App\Models'.'\\'.$model;
        $product = $model::find($id);
        $product->delete();
        return redirect('/admin');
    }
}
