<?php

if (!function_exists('SelectAll')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function SelectAll($tables,$name)
    {

        $dropdown = '';
        
        $val=${$name};
    
    
        foreach ($tables as $table) {       
      
    
            $dropdown .= '<option  value="' . $table->id . '">' . $table->$val . '</option>';
    
        
        }
    
        return $dropdown;

    }
}
