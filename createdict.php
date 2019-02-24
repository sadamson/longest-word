<?php
/**
 *
 * Run once to precompile the dict file to specifications of your use case
 * The file usa.txt is not my original work, but pulled from JUST WORDS! website
 * http://www.gwicks.net/justwords.htm
 *
 */
$dict = explode("\n",file_get_contents('./usa.txt'));
$config = json_decode(file_get_contents('./config.json'));
$allwords = [];

foreach($dict as $word) {
    if (strlen($word) < $config->min_word_length) continue;
    if (strlen($word) > $config->max_word_length) continue;
    if ($config->drop_contractions && strpos($word,"'")) continue; // conjunctions
    $allwords[] = $word;
}

if ($config->sort_by_length) {
    // Sort longest to shortest. Note that the raw file is already sorted alphabetically
    usort($allwords, function ($a, $b) {
        return strlen($b)-strlen($a);
    });
}


// Write out dict file, overwrite existing
$mydict = fopen('./dict.txt',"w");
foreach($allwords as $word) {
    fwrite($mydict,$word."\n");
}
fclose($mydict);

echo "Succesfully created dict file";