# From-CRM-extension
This extension to pass updated data from CRM to OCS

handle events in hooks, take actions on magentoPush.php<br />
1- create event hooks form (Contacts,AOS_Products_Quotes,Cases,ksk05_Header3)<br />
2- create php (magentoPush.php) file to take actions for handled events<br />
3- copy magentoPush.php from extension folder to custom/modules/magentoPush.php<br />
4- link the hooks with magentoPush.php by spacify the path in manifest ('file' => 'custom/modules/magentoPush.php')<br />

