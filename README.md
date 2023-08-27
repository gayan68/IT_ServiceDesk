# IT_ServiceDesk
Inventory application for IT departments to manage computer devices and printer toners. Also, this application has a module for system change management with an approval workflow.

<br />
The excel export does not support above PHP 7.2 at the moment.

<h2>Prerequisite</h2>
Apache, PhP 7.2 and MySQL

<h1>How to Setup</h1>
<ul>
<li>1. Copy code to your web root.</li>
<li>2. Create a MySQL DB and restore database.sql (this is inlude in the root of the sorce code).</li>
<li>3. Open "config.php" and set your Database, DB user, DB password.</li>
<li>4. Update your company details in setting table in the database.</li>
<li>5. Update Active Directory user and password in setting table if you use this application in a Microsoft AD environment.
Then you'll be able to query AD users and assign inventory item to them in the IT_ServiceDesk.</li>
</ul>

<h3>Login Details</h3>
Username - root <br />
Password - 12345678
<br /><br />
Good Luck!
