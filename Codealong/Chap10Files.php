<?php

$path = "c:\PHP\students.txt";
printf("The size of the file is %s bytes<BR>", filesize($path));
printf("The file name is %s <BR>", basename($path, ".txt"));
printf("folder only %s <BR>", dirname($path));

//relativae file path
$relPath="../images/logo.jpg";
echo "absolute path is " .realpath($relPath)."<BR>"; 
printf("The size of the file is %s kilobytes<BR>", round(filesize($relPath)/1024,2));
echo "DISK SPACE REMINING: " . disk_free_space("c:\\"). "<BR>";
echo "DISK TOTAL REMINING: " . disk_total_space("c:\\"). "<BR>";
date_default_timezone_set("America/Halifax");
//g means 12 hour format, G means is 24 hour format
//i means minutes with leading zeroes
//s means seconds with leading zeroes
//a means lowercase am/pm, A would be upper case AM/PM
echo "file last accessed " . date("m-d-y h:i:sa",fileatime($relPath)). "<BR>";
echo "file last modified " . date("m-d-y g:i:sa",filemtime($relPath)). "<BR>";

//open the file
//r means read
//w means write
//x mean create
//w+ means read and write
//a means append to the end
$myFile = fopen($path, "w+");
fwrite($myFile,"Johny\n");
fwrite($myFile,"Phoebe\n");
fwrite($myFile,"Marina\n");
fwrite($myFile,"Pavani\n ");
rewind($myFile);//move the file pointer to the beginning of the file
while(!feof($myFile)){
    //fgets reads a line
    //fgets reads a single character
    //fread ignores line feed character
    echo fgets($myFile). "<BR>";
 
}
fclose($myFile);
