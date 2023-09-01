DROP TABLE IF EXISTS Applicants_Application_Status;
DROP TABLE IF EXISTS Applicants_login;
DROP TABLE IF EXISTS Applicants_General_Details;
DROP TABLE IF EXISTS University_admins;
DROP TABLE IF EXISTS University_requirements;
DROP TABLE IF EXISTS Research_output;
DROP TABLE IF EXISTS GRE_waiver;
DROP TABLE IF EXISTS University_Size;
DROP TABLE IF EXISTS University_Type;
DROP TABLE IF EXISTS Country;
DROP TABLE IF EXISTS Region;
DROP TABLE IF EXISTS degree_table;

CREATE TABLE Country (
CID VARCHAR(10) PRIMARY KEY,
Country VARCHAR(255)
);

CREATE TABLE Region (
RID VARCHAR(10) PRIMARY KEY,
region VARCHAR(255)
);

CREATE TABLE University_Type (
TID VARCHAR(10) PRIMARY KEY,
university_type VARCHAR(255)
);
CREATE TABLE University_Size (
SID VARCHAR(10) PRIMARY KEY,
Uni_size VARCHAR(255)
);

CREATE TABLE GRE_waiver (
GRE_ID VARCHAR(10) PRIMARY KEY,
GRE_waiver_options VARCHAR(255)
);
CREATE TABLE Research_output (
RO_ID VARCHAR(10) PRIMARY KEY,
research_outputs VARCHAR(255)
);
CREATE TABLE Degree_Table (
Degree_ID VARCHAR(10) PRIMARY KEY,
Degree_Level VARCHAR(255)
);

CREATE TABLE University_requirements (
UID VARCHAR(10) PRIMARY KEY,
Uni_name VARCHAR(100),
TID VARCHAR(10),
CID VARCHAR(10),
RID VARCHAR(10),
RO_ID VARCHAR(10),
SID VARCHAR(10),
rank_display VARCHAR(10),
student_faculty_ratio DECIMAL(10, 2),
GRE_ID VARCHAR(10),
GRE_Score VARCHAR(20),
IELTS DECIMAL(10, 2),
TOEFL VARCHAR(5),
GPA VARCHAR(5),
link VARCHAR(255),
FOREIGN KEY (TID) REFERENCES University_Type(TID),
FOREIGN KEY (CID) REFERENCES Country(CID),
FOREIGN KEY (RID) REFERENCES Region(RID),
FOREIGN KEY (GRE_ID) REFERENCES GRE_waiver(GRE_ID),
FOREIGN KEY (RO_ID) REFERENCES Research_output(RO_ID),
FOREIGN KEY (SID) REFERENCES University_Size(SID)
);

CREATE TABLE Applicants_General_Details (
Applicant_Id VARCHAR(20) PRIMARY KEY,
applicant_name VARCHAR(255),
CGPA VARCHAR(10),
GRE VARCHAR(10),
TOEFL VARCHAR(10),
IELTS DECIMAL(10, 2) ,
research VARCHAR(2),
Degree_ID VARCHAR(10),
universities_applied INT,
CID VARCHAR(10),
FOREIGN KEY (Degree_ID) REFERENCES Degree_Table(Degree_ID),
FOREIGN KEY (CID) REFERENCES Country(CID)
);

CREATE TABLE Applicants_Application_Status (
Applicant_Id VARCHAR(20),
UID VARCHAR(10),
course_name VARCHAR(255),
Degree_ID VARCHAR(10),
Status VARCHAR(10),
PRIMARY KEY (Applicant_Id,UID),
FOREIGN KEY (Applicant_Id) REFERENCES Applicants_General_Details(Applicant_Id),
FOREIGN KEY (UID) REFERENCES University_requirements(UID),
FOREIGN KEY (Degree_ID) REFERENCES Degree_Table(Degree_ID)
);

CREATE TABLE University_admins (
UID VARCHAR(10) PRIMARY KEY,
email VARCHAR(255),
password VARCHAR(255),
FOREIGN KEY (UID) REFERENCES University_requirements(UID)
);

CREATE TABLE Applicants_login (
Applicant_id VARCHAR(20) PRIMARY KEY,
email VARCHAR(255),
password VARCHAR(255),
FOREIGN KEY (Applicant_id) REFERENCES Applicants_General_Details(Applicant_Id)
);
