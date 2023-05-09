<?php

function recursiveAddStructureDropdown($structures, $prefix = '', $idSource,$parenId)
{
    $dropdown = '';
    $val='>';

    

    foreach ($structures as $structur) {
       
        if($structur->id <> $idSource){


            if($parenId==$structur->id){ $val= 'selected="selected">'; } 



        $dropdown .= '<option  value="' . $structur->id . '"'. $val . $prefix . $structur->name . '</option>';

        if (count($structur->children) > 0) {
            $dropdown .= recursiveAddStructureDropdown($structur->children, $prefix . $structur->name . '/', $idSource,$parenId);
        }
    }
    }
    return $dropdown;
}
