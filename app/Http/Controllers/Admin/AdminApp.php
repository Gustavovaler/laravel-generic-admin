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
      $data_info[$table] = DB::select('describe '.$table);
      $form_fields =[];
      foreach ($data_info[$table] as $key) {
        $obj = array();
        foreach ($key as $attr => $value) {
          if ($attr == 'Field') {
            $obj['name'] = $value;
          }
          if ($attr == 'Type') {
            if ($value == 'varchar(191)') {
                $obj['type'] = 'text';
            }
            if ($value == 'text') {
              $obj['type'] = 'textarea';
            }
            if ($value == 'timestamp') {
              $obj['type'] = 'datetime';
            }
            if ($value == 'int(11)') {
              $obj['type'] = 'number';
            }
            
          }
        }
        array_push($data, $obj);
      }
      //dd($data_info);
      //dd($data);
    return $data;
  }
}