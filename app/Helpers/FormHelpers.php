// app/Helpers/FormHelpers.php

function oldSelectValue($field, $value) {
    return old($field) == $value ? 'selected' : '';
}
