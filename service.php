<?php
/**
 * ajax service for finding the words in the dictionary file.
 * The dictionary file is pre-compiled using createdict
 * (by default is 53,000 words 6 characters or more, presorted by length order)
 * Letters are provided in aritrary order.
 *
 *
 * ./service.php?letters=abcdefg&results=10
 */
$config = json_decode(file_get_contents('./config.json'));
$letters = strtolower($_GET['letters']);
$results = intval( $_GET['results']) ?: $config->max_letters;
$matches = [];

if (strlen($letters) >= 6) {

    $potentials = explode("\n",file_get_contents('./dict.txt'));

    foreach($potentials as $candidate) { // Loop through all entries looking for matches
        if (isMatch($candidate, $letters)) {
            $matches[] = $candidate;
        }
        // Quit when we've hit our limit; these will be the longest possible because that's how the dict file is sorted
        if (count($matches) == $results) break;
    }
}

function isMatch($candidate, $letters) {
    if (count(array_diff(str_split($candidate),str_split($letters))) == 0) { // Checks that all letters are in the string
        $letterCounts = count_chars($letters,1);
        foreach(count_chars($candidate,1) as $char => $count) { // Checks that we have enough of each letter
            if ($letterCounts[$char] < $count) {
                return false;
            }
        }
        return true;
    }
    return false;
}

header('Content-Type: application/json');
echo json_encode($matches);