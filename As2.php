<?php
// API endpoint
$url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch data
$response = @file_get_contents($url);

// Check response
if ($response === false) {
    echo "<p>Error: Cannot connect to API.</p>";
} else {
    // Decode JSON
    $data = json_decode($response, true);

    if ($data === null) {
        echo "<p>Error: Invalid API response format.</p>";
    } elseif (isset($data['results']) && count($data['results']) > 0) {
        // Start table
        echo '<table>';
        echo '<thead><tr>';
        echo '<th>Year</th><th>Semester</th><th>Program</th><th>Nationality</th><th>Colleges</th><th>Number</th>';
        echo '</tr></thead><tbody>';

        // Populate table
        foreach ($data['results'] as $record) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($record['year'] ?? 'N/A') . '</td>';
            echo '<td>' . htmlspecialchars($record['semester'] ?? 'N/A') . '</td>';
            echo '<td>' . htmlspecialchars($record['the_programs'] ?? 'N/A') . '</td>';
            echo '<td>' . htmlspecialchars($record['nationality'] ?? 'N/A') . '</td>';
            echo '<td>' . htmlspecialchars($record['colleges'] ?? 'N/A') . '</td>';
            echo '<td>' . htmlspecialchars($record['number_of_students'] ?? 'N/A') . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo "<p>No data available.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Student Nationalities</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <style>
        /* Center text in table */
        th, td {
            text-align: center;
        }
        /* Alternate row color */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <main class="container"></main>
</body>
</html>
