<?php

function recursiveStructureDropdown($structures, $prefix = '', $idSource)
{
    $dropdown = '';
    $val='>';


    foreach ($structures as $structur) {
       


            if($idSource==$structur->id){ $val= 'selected="selected">'; } else {$val='>';}



        $dropdown .= '<option  value="' . $structur->id . '"'. $val . $prefix . $structur->name . '</option>';

        if (count($structur->children) > 0) {
            $dropdown .= recursiveStructureDropdown($structur->children, $prefix . $structur->name . '/', $idSource);
        }
  
    }

    return $dropdown;
}



