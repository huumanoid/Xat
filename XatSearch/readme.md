<h1>XatSearch</h1>

This tool will get all messages where it says the word you have chosen from http://xat.com/web_gear/chat/search.php. <br />
For example, I want to search for "sloom", it will fetch all messages with "sloom".

<h1>Requirement</h1>
<ul>
    <li>NodeJS</li>
    <li>NPM</li>
</ul>

<h1>Install</h1>
```
npm install request
npm install cheerio
```

<h1>How to run it?</h1>
Go in the folder where the JS file is, and type this command: 
```
node FILENAME.js
```
Of course, replace "FILENAME" with your file name.
If the script has found something, it would showing like that (for example): 

```
Please wait until we have fetched everything...
Name :assilolalgerois
Message : sloom  (d) 
Xat: xat.com/Aide

Name :LdsaoLdsao
Message : !fortune sloom
Xat: xat.com/xat_test

Name :1520832531
Message : sloom
Xat: xat.com/Aide

Name :TrejosTaco
Message :  (C)  Sloom
Xat: xat.com/xat_test

Name :FEXBot
Message : Hello; SlOom.
Xat: xat.com/xat_test

Name :minerva56
Xat: xat.com/xat_test

Name :1520208985
Message : jij bent te oud en sloom el 
Xat: xat.com/BMR_radio

Name :Sangoku
Message : !bump Sloom
Xat: xat.com/Aide

Name :1520880990
Message : sloom
Xat: xat.com/Aide

Name :Matheus
Message : and tbh sloom shouldn't be owner
Xat: xat.com/Phin

Name :xPika
Message : He made sloom owner about a week ago
Xat: xat.com/Phin

Name :ider
Message : !dunce Sloom
Xat: xat.com/xat_test
```

Otherwise, it will return an error :
```
No results found c:
```
If you want to change the value to search, you can edit this line:
```
init('sloom');
```
<h1>Bugs/Issues</h1>
Feel free to open a new issue if you have found some bugs/issues.
