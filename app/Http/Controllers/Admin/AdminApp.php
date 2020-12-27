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
            'Marca'   => 'marcas',
            'Modelo' => 'modelos'
                    
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
  /**
   * @param $str string
   * @param $sample string
   * @return boolean
   */

  public function starts_with($str, $sample){
    
    return substr($str,0, strlen($sample));;
  }

  public function build_form($model){
      // at first we select the table 
      $table = $this->models[$model];
      $data = [];        
      $data_info[$table] = DB::select('describe '.$table);
      foreach ($data_info[$table] as $key) {
        $obj = array();
        foreach ($key as $attr => $value) {
          if ($attr == 'Field') {
            $obj['name'] = $value;
          }
          if ($attr == 'Type') {
            if ($this->starts_with($value,'varchar')) {
                $obj['type'] = 'text';
                $obj['max'] = 191;
            }
            if ($value == 'text') {
              $obj['type'] = 'textarea';
            }
            if ($value == 'timestamp') {
              $obj['type'] = 'datetime';
            }
            if ($value == 'int(11)') {
              $obj['type'] = 'number';
              $obj['max'] = 11;
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