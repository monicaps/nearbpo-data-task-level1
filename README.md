# Home assignment for Data Engineering candidates - Level 1

Hi candidate! Please, read carefully the instructions provided below and complete all the tasks requested. Some of the tasks will require a *minimal* solution to pass, while you will be awarded bonus points if you choose to complete the *preferred* solution. We will evaluate your performance focusing on:

**Hard skills**: Data modeling and programming using best practices

**Soft skills**: Attention to detail, willingness to learn, communication & proactivity.

Good luck!!

# 1 Fork this repository

Fork this repository into your own GitHub account and provide the URL in order to validate your assingment.

# 2. Create a database

In this step you are required to create a database schema for storing weather information. You may select a database management system of your choice. Define a schema with the following tables and save the statements needed into a text file.

```
stations = (
  station_id int primary key,
  name varchar,
  latitude double,
  longitude double,
  elevation double
)

variables = (
  variable_id char(16) primary key,
  name varchar,
  description varchar
  units varchar
)

observations = (
  sensor_id int,
  variable_id char(16),
  observation_date timestamp,
  observed_value double,
  status char(2)
)
```

Table *stations* holds the name, geographic location (latitude/longitude) and elevation of all the weather sensors we have in our application. Table *variables* holds all the climate variables (for now, just maximum temperature) for which we will store observed data. Finally, table *observations* stores all the observed data for each *station* and *variable*. Each observation has a timestamp that uniquely identifies and observation for any given station and variable. All the observations have a status flag for quality-control purposes (N = not controlled, A = anomaly, V = valid).

**Minimal solution**: Create a relational schema using a RDBMS of your choice (MySQL, PostgreSQL, etc.). Provide all the SQL statements needed to create the schema (if you want to use a NoSQL database, go ahead!).

**Preferred solution**: Use AstraDB, a cloud-native implementation of Apache Cassandra. You may register for free at https://astra.datastax.com/register (you will get a $25 credit, more that enough to run this task). If you choose this option, explain all the steps needed to create the schema.

# 3. Collect the information for populating your database

You will notice that there is a *data* folder in this repo that contains CSV files for populating tables *stations* and *variables*, but there is no data for table *observations*. In this case you will have to collect the data for each of the 5 stations. Data can be found at

```
http://www.inia.org.uy/online/site/gras_datos.php?filtro=<STATION_ID>&fecha_des=<START_DATE>&fecha_has=<END_DATE>&ver=20000&campos=15`**,
```

where STATION_ID is the primary key of table *stations* and START_DATE/END_DATE is the time interval for the observations (both dates are in *yyyy-mm-dd* format).

Find all the information for every station for years 2019, 2020 and 2021 and store it in table *observations*.

**Minimal solution**: Retrieve the information using the "Export" button found at the top-right corner. Do you need to convert the file to any specific format?

**Preferred solution**: Retrieve the information programatically by *scaping* the web pages using any programming language of your choice (Python/R are recommended for such tasks).

# 4. Populate your database

Import the data retrieved into your *observations* table. For this task, you will be required to import the data programmatically using any programming language of your choice (Python/R are recommended). If your selected to work with AstraDB, you may import the data for the UI. In this case, explain the steps needed and list the available options provided by the platform.

# 5. Use your database

Implement a client to interact with your database. The client must perform all 4 CRUD operations (Create/Read/Update/Delete).

**Minimal solution**: Implement a CLI (command line interface) using any programming language of your choice.

**Preferred solution**: Implement an interactive web application using any programming language of your choice (running the application as a Docker container will give you bonus points!).
