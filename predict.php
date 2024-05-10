<?php
// Get input symptoms from AJAX request
// Get input symptoms from AJAX request
$symptoms = $_POST['symptoms'];
$pythonScript = "xai_pred-Copy1.py";

// Pass input symptoms to Python script and capture output
$pythonOutput = shell_exec("python $pythonScript \"$symptoms\"");

// Split the Python output into two parts based on the first occurrence of "Diagnosis:"
$outputParts = explode("Diagnosis:", $pythonOutput);

// Output predicted disease
echo "Predicted disease: " . $outputParts[0] . "\n";
echo "Diagnosis: " . $outputParts[1];

?>
