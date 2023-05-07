<?php

// Load the XML file into a SimpleXML object
$xml = simplexml_load_file('directory.xml');

// Search for businesses that match the search term and location
$matches = [];
$search_term = isset($_POST['search-term']) ? $_POST['search-term'] : '';
$search_location = isset($_POST['search-location']) ? $_POST['search-location'] : '';



foreach ($xml->business as $business) {
    // Check if search term and/or location match any of the fields
    $search_term_match = ($search_term === '' || stristr($business->name, $search_term) !== false || stristr($business->address, $search_term) !== false || stristr($business->phone, $search_term) !== false || stristr($business->email, $search_term) !== false || stristr($business->website, $search_term) !== false || stristr($business->category, $search_term) !== false || stristr($business->description, $search_term) !== false);
    $search_location_match = ($search_location === '' || stristr($business->address, $search_location) !== false);

    if ($search_term_match && $search_location_match) {
        $matches[] = $business;
    }
}


// Output the search results as HTML
if (count($matches) > 0) {
    foreach ($matches as $match) {
        echo "<h2>{$match->name}</h2>";
        echo "<p>{$match->description}</p>";
        echo "<p>Address: {$match->address}</p>";
        echo "<p>Phone: {$match->phone}</p>";
        echo "<p>Email: {$match->email}</p>";
        echo "<p>Website: {$match->website}</p>";
        echo "<hr>";
    }
} else {
    echo "<p>No matches found</p>";
}

?>
