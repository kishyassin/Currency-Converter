<?php
// This Function is used to open the form
function formOpen($name='', $action='#', $method = 'post', $enctype = 'application/x-www-form-urlencoded', $target = '_self')
{
    return "<form name='$name' action='$action' method='$method' enctype='$enctype' target='$target'>";
}

// This function is used to close the form
function formClose()
{
    return '</form>';
}

// This Function Can Generate almost ALL HTML input types
function generateInput($type, $name, $value = '', $attributes = [])
{

    $attributeString = '';
    foreach ($attributes as $key => $val) {
        $attributeString .= " $key='$val'";
    }

    return "<input type='$type' name='$name' value='$value'$attributeString />";
}

// This Function is specified only for Text type of HTML input
function reservedInputText($name, $reserved = true, $attributes = [])
{
// turn attributes into a string 
    $attributeString = '';
    foreach ($attributes as $key => $val) {
        $attributeString .= " $key='$val'";
    }
// reserve last values
    if($reserved and isset($_POST[$name]))
        $value = $_POST[$name] ;
    else $value ='';
    return "<input type='text' name='$name' value='$value'$attributeString />";}

// This function is specified to create CheckBox HTML input
function reservedInputCheckbox($name, $value='' , $reserved=true, $attributes = [])
{
    $attributeString = '';
    foreach ($attributes as $key => $val) {
        $attributeString .= " $key='$val'";
    }
    // reserve last values
    if($reserved and isset($_POST[$name]))
    $attributeString .= ' checked' ;

    return "<input type='checkbox' name='$name' value='$value'$attributeString />";}

// This function is used to send the form
function inputSubmit($name, $value = 'Submit', $attributes = [])
{
    // the default value is set to Submit
    return generateInput('submit', $name, $value, $attributes);
}

// This function is used to reset the form
function inputReset($name, $value = 'Reset', $attributes = [])
{
    // the default value is set to Reset
    return generateInput('reset', $name, $value, $attributes);
}

function createSelect($name, $options, $selected = null, $attributes = array()) {
    $select = '<select name="' . htmlspecialchars($name) . '"';

    // Add any additional attributes to the select tag
    foreach ($attributes as $key => $value) {
        $select .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
    }

    $select .= '>';

    foreach ($options as $value => $label) {
        $option = '<option value="' . htmlspecialchars($label) . '"';
        if ($selected !== null && $selected == $value) {
            $option .= ' selected="selected"';
        }
        $option .= '>' . htmlspecialchars($label) . '</option>';
        $select .= $option;
    }

    $select .= '</select>';

    return $select;
}

function reservedSelect($name, $options, $attributes = array()) {
    $select = '<select name="' . htmlspecialchars($name) . '"';
    if(isset($_POST[$name])){
        $selected = $_POST[$name];
    }
    else
        $selected = '';
    
    // Add any additional attributes to the select tag
    foreach ($attributes as $key => $value) {
        $select .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
    }

    $select .= '>';
    foreach ($options as $label => $value) {
        $option = '<option value="' . htmlspecialchars($label) . '"';
        
        if ($selected !== null && $selected == $label) {
            $option .= ' selected="selected"';
        }
        
        $option .= '>' . htmlspecialchars($label) . '</option>';
        $select .= $option;
    }

    $select .= '</select>';

    return $select;
}

// This function is used to create input text boxes
function inputText($name, $value = '', $attributes = [])
{
    return generateInput('text', $name, $value, $attributes);
}

// This function is specified to create CheckBox HTML input
function inputCheckbox($name, $value = '', $attributes = [])
{
    return generateInput('checkbox', $name, $value, $attributes);
}
// this function is used to generate textarea ;
function createTextarea($name, $rows = 5, $cols = 40, $placeholder = '', $value = '', $attributes = array()) {
    $textarea = '<textarea name="' . htmlspecialchars($name) . '" rows="' . (int)$rows . '" cols="' . (int)$cols . '"';

    if (!empty($placeholder)) {
        $textarea .= ' placeholder="' . htmlspecialchars($placeholder) . '"';
    }

    // Add any additional attributes to the textarea
    foreach ($attributes as $key => $attr) {
        $textarea .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($attr) . '"';
    }

    $textarea .= '>';
    $textarea .= htmlspecialchars($value, ENT_QUOTES); // You can choose to escape the initial value as well

    $textarea .= '</textarea>';

    return $textarea;
}


?>
