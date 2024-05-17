<?php

// Define the MyService class
class MyService
{
    private $payload;

    // Constructor
    public function __construct($flow, $registerConnection, $inputFormat, $outputFormat, $inputTarget, $outputTarget, $input, $output)
    {
        // No need to read input data in the constructor for API scenario
    }

    // Process method
    public function Process(array $payload = null): void
    {
        // Check if payload is provided, otherwise initialize it as an empty array
        $this->payload = $payload ?? [];

        // Fetch data from the API
        $apiUrl = 'http://127.0.0.1:5000/get-user/john'; // Replace with your API URL
        $apiResponse = file_get_contents($apiUrl);

        // Check for API request errors
        if ($apiResponse === false) {
            // Handle API request error
            throw new RuntimeException("Failed to fetch data from API: " . error_get_last()['message']);
        }

        // Decode API response
        $apiData = json_decode($apiResponse, true);

        // Check if JSON decoding was successful
        if ($apiData === null) {
            // Handle JSON decoding error
            throw new RuntimeException("Failed to decode API response: " . json_last_error_msg());
        }

        // Process API data and convert it to CSV format
        $flatData = [["name", "email"]];
        $flatData[] = [$apiData["name"], $apiData["email"]];

        // Update payload with processed data
        $this->payload = $flatData;
    }

    // Implement __toString method to represent object as a string
    public function __toString()
    {
        // Return payload as a CSV string
        $csvString = '';
        foreach ($this->payload as $row) {
            $csvString .= implode(',', $row) . PHP_EOL;
        }
        return $csvString;
    }
}

// Create an instance of MyService
$service = new MyService(
    'in',
    true,
    'json',
    'csv',
    'api',
    'file',
    '', // Empty string for input since data will be fetched from API
    'output.csv'
);

// Process data
$service->Process();
echo $service;
// Save the CSV output to a file
file_put_contents('output.csv', (string)$service);

echo 'Data fetched from API and saved as CSV file successfully.';
