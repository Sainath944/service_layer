<?php

// Define the MyService class
class MyService
{
    private $payload;

    // Constructor
    public function __construct($flow, $registerConnection, $inputFormat, $outputFormat, $inputTarget, $outputTarget, $input, $output)
    {
        // Validate parameters
        // Here, you should perform validations and error handling
        // For simplicity, I'm skipping validations in this example

        // Read input data from the input file
        if ($flow == 'in' && $inputTarget == 'file' && $inputFormat == 'json') {
            $this->payload = json_decode(file_get_contents($input), true);
        }
    }

    // Process method
    public function Process(array $payload = null): void
    {
        $this->payload = $payload ?? $this->payload;
        foreach ($this->payload['data'] as &$item) {
            $item['value'] *= 2;
        }
    }

    // Implement __toString method to represent object as a string
    public function __toString()
    {
        return json_encode($this->payload, JSON_PRETTY_PRINT);
    }
}

// Create an instance of MyService
$service = new MyService(
    'in', 
    true, 
    'json', 
    'json', 
    'file', 
    'file', 
    'put.json', 
    'output.json'
);
$nervice = new MyService(
    'in' , 
    true , 
    'json' , 
    'json' , 
    'file' , 
    'file' , 
    'input.json' , 
    'output.json'
);


// Process data
$service->Process();
$nervice -> Process();
// Output the result
echo $service;
echo $nervice;


?>
