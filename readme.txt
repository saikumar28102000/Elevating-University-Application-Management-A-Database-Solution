Creating DB
1. Open PHPMyAdmin and select the database you want to use.
2. Click on the SQL tab in the top navigation bar.
3. In the SQL window, enter the SQL command to create a table. The syntax for creating a table is as follows:
4. Once you have entered the SQL command from the Create_table txt, click on the "Go" button to execute it.
5. If the table is created successfully, you will see a message saying "Your SQL query has been executed successfully".
6. You can then view the table structure by selecting the table in the left-hand menu and clicking on the "Structure" tab.
After creating the table, you can then load data from the TXT file into the table using the "Import" feature in PHPMyAdmin. Here are the steps for that:
1. Click on the "Import" tab in the top navigation bar.
2. In the "File to Import" section, click on the "Choose File" button and select the TXT file you want to import.
3. Under "Format", select "CSV" as the file format.
4. Under "Options", set the appropriate values for the fields such as delimiter and enclosure.
5. Click on the "Go" button to start the import process.
6. Once the import is complete, you will see a message saying "Import has been successfully finished".


Website Running:
1. Start XAMPP: Launch XAMPP control panel and start the Apache and MySQL.
2. Import the database: In the XAMPP control panel, click on the "Admin" button next to MySQL to open phpMyAdmin in a web browser. In phpMyAdmin, create a new database and import the SQL file located in the "database" folder of the project folder.
3. Copy the project folder: Copy the project folder to the "htdocs" folder in the XAMPP installation directory.
4. Access the project: Open a web browser and enter the following URL in the address bar: http://localhost/DMQL_WEB_src
5. Use the website: Once the website is loaded, you can use the different features of the website such as searching for universities, adding new universities, updating university information, and deleting universities.

