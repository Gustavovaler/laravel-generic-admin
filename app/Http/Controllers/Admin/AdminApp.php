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
                    
        ];
    }

    public function get_models_name(){
        $model_names = array_keys($this->models);
        return $model_names;
    }

    public function get_fields($table){
        $data = [];        
        $data[$table] = DB::select('describe '.$table); 
        $fields = [];
        foreach ($data[$table] as $key ) {
           array_push($fields,$key->Field);
        }       
               
      return $fields;
  }

  public function build_form($model){
      $table = $this->models[$model];
      $table_data = $this->get_fields($table);
    return $table_data;
  }
}