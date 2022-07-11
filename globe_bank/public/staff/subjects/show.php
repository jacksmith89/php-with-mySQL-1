<?php
// Jul 10, 2022 12:13:47 Below is the "Null Coalescing Operator", "??". If the first operand is null or doesn't exist, it returns the second operand. This is essentially a shorthand version of "Is this variable set? If not, print this instead". Only works in PHP 7 or higher.
$id = $_GET['id'] ?? '1'; // PHP > 7

// Jul 10, 2022 12:20:24 Another shorthand option using a ternary expression, where the "?" and ":" are essentially "if" and "else".
// $id = isset($_GET['id']) ? $_GET['id'] : '1';

// Jul 10, 2022 12:19:45 Longhand way of checking whether $id is set, and providing a default value if not.
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
// } else {
//     $id = '1';
// }

echo $id;
