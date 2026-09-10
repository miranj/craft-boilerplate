<?php
/**
 * Typogrify plugin config
 */

return [
    'set_hyphenation' => false,
    'set_space_collapse' => false,

    // enables/disables wrapping of Em and En dashes in thin spaces.
    'set_dash_spacing' => false,

    // establishes maximum length of a widows that will be protected
    'set_max_dewidow_length' => 15,

    // establishes maximum length of pulled text to keep widows company
    'set_max_dewidow_pull' => 10,

    // replaces 2^4 with 2<sup>4</sup>
    'set_smart_exponents' => false,

    // replaces 1/4  with <sup>1</sup>&#8260;<sub>4</sub>
    'set_smart_fractions' => false,

    // replaces (r) (c) (tm) (sm) (p) (R) (C) (TM) (SM) (P) with ® © ™ ℠ ℗
    'set_smart_marks' => false,
];
