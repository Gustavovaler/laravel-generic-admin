<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;

class AdminApp
{
    protected $models;
    
    public function __construct()
    {   
       $this->register();
    }

    public function register(){
         $this->models = [
            'User' =>'users',
            'Product' => 'products',
            'Course'  => 'courses',
            'Program' => 'programs', 
            'Marca'   => 'marcas'
                    
        ];
    }

    public function get_models_name(){
        $model_names = array_keys($this->models);
        //returns an array with names of all models 
        return $model_names;
    }

    public function get_fields($table){
        $data = [];        
        $data[$table] = DB::select('describe '.$table); 
        $fields = [];
        foreach ($data[$table] as $key ) {
           array_push($fields,$key->Field);
        }     
        //returns a field list as an array                 
      return $fields;
  }

  public function build_form($model){
      // at first we select the table 
      $table = $this->models[$model];
      $data = [];        
      $data[$table] = DB::select('describe '.$table);

    return $data;
  }
}