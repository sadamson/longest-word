# Word Lookup

This is a quick and dirty PHP app for finding the longest word in a random set of provided letters.

Written as a cheat for the old game Bookworm Adventures but really any game where the goal is to find the best word in a shuffled collection of letters.

The app is real time updating and quite fast. The core of the logic is the function isMatch() in service.php 

Customize the config file to your desired dictionary and run createdict.php once to create the file. The longest word in the current dictionary file is 24 letters.

The raw dictionary comes from the JUST WORDS! website. I used US English basic but feel free to play with alternatives:
http://www.gwicks.net/justwords.htm

Possible improvements:
- Treat 'q' as 'qu' for apps that combine into one
- Add a scoring system (not all words of equal length are equally strong)
