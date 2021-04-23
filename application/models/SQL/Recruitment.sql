-- NEW TABLES;




-- Remove COlumn 
 'alter table "HRISVISMA2"."HRIS_REC_APPLICATION_PERSONAL" drop ("MARITAL_INPUT")';

ALTER TABLE "HRISVISMA2"."HRIS_REC_VACANCY_USERS" ADD (RESET_STATUS BOOLEAN DEFAULT 0);
-- DELETE BELOW TABLES
-- OLD TABLES;


CREATE TABLE HRIS_REC_APPLICATION_FAMILY
(
    FAMILY_ID NUMBER(7,0) PRIMARY KEY,
    APPLICATION_ID NUMBER (10,0),    
    STATUS CHAR(1) DEFAULT 'E',
    CREATED_DATE DATE DEFAULT CURRENT_DATE,
    MODIFIED_DATE DATE DEFAULT NULL
);
-- USERS
CREATE TABLE HRIS_REC_VACANCY_USERS
(
    USER_ID NUMBER(7,0) NOT NULL PRIMARY KEY,
    EMAIL_ID VARCHAR(40) NOT NULL,
    USERNAME VARCHAR(30) NOT NULL,
    PASSWORD VARCHAR(20) NOT NULL,
    CREATED_DT DATE,
);
-- REGISTRATION
CREATE TABLE HRIS_REC_USERS_REGISTRATION
(
    REGISTRATION_ID NUMBER(10,0) PRIMARY KEY,
    USER_ID NUMBER(7,0) NOT NULL,
    FIRST_NAME VARCHAR(20) NOT NULL,
    MIDDLE_NAME VARCHAR(20),
    LAST_NAME VARCHAR(20) NOT NULL,
    AGE NUMBER(3,0) NOT NULL,
    MOBILE_NO NUMBER(10,0) NOT NULL,
    PHONE_NO NUMBER(9,0),
    GENDER_ID NUMBER(1,0),--FK
    DOB DATE NOT NULL,
    CITIZENSHIP_NO VARCHAR(10),
    CTZ_ISSUE_DISTRICT_ID NUMBER(7,0) NOT NULL,
    CTZ_ISSUE_DATE DATE NOT NULL,
    FATHER_NAME VARCHAR(50) NOT NULL,
    MOTHER_NAME VARCHAR(50) NOT NULL,
    SPOUSE_NAME VARCHAR(50) DEFAULT NULL,
    CREATED_DT DATE,
    MODIFIED_DT DATE DEFAULT NULL
);
-- ADDRESS
CREATE TABLE HRIS_REC_USERS_ADDRESS
(
    USERS_ADDRESS_ID NUMBER(7,0) PRIMARY KEY,
    USER_ID NUMBER(9,0) NOT NULL, --FK
    PER_PROVINCE_ID NUMBER (7,0) NOT NULL,
    PER_DISTRICT_ID NUMBER (7,0) NOT NULL,
    PER_VDC_ID NUMBER (7,0) NOT NULL,
    PER_WARD_NO NUMBER (7,0),
    PER_TOLE VARCHAR(50),
    MAIL_PROVINCE_ID NUMBER(7,0) NOT NULL,
    MAIL_DISTRICT_ID NUMBER(7,0) NOT NULL,
    MAIL_VDC_ID NUMBER (7,0) NOT NULL,
    MAIL_WARD_NO NUMBER (7,0),
    MAIL_TOLE VARCHAR(50),
    STATUS CHAR(1) DEFAULT 'E',
    CREATED_DATE DATE DEFAULT CURRENT_DATE,
    MODIFIED_DT DATE DEFAULT NULL

);


CREATE TABLE HRIS_REC_DOCUMENTS
(
    REC_DOC_ID NUMBER (7,0) PRIMARY KEY,
    REG_ID NUMBER (7,0), --FK
    USER_ID NUMBER(7,0), --FK
    DOC_OLD_NAME VARCHAR(255),
    DOC_NEW_NAME NVARCHAR(255),
    DOC_PATH NVARCHAR(255),
    DOC_TYPE VARCHAR(50),
    STATUS CHAR(1) DEFAULT 'E'
);


CREATE TABLE HRIS_REC_SERVICE_EVENTS_TYPES
(
    SERVICE_EVENT_ID NUMBER(7,0),
    SERVICE_EVENT_NAME VARCHAR(100) NOT NULL,
    SERVICE_EVENT_CODE VARCHAR(15) DEFAULT NULL,
    REMARKS VARCHAR(255) DEFAULT NULL,
    STATUS CHAR(1) DEFAULT 'E',
    CREATED_DATE DATE DEFAULT CURRENT_DATE
);

INSERT INTO HRIS_REC_MOTHER_TONGUE (LANGUAGE_ID,LANGUAGE_NAME) VALUES (1, 'English');
INSERT INTO HRIS_REC_MOTHER_TONGUE (LANGUAGE_ID,LANGUAGE_NAME) VALUES (2, 'Nepali');
INSERT INTO HRIS_REC_MOTHER_TONGUE (LANGUAGE_ID,LANGUAGE_NAME) VALUES (3, 'Newari');
INSERT INTO HRIS_REC_MOTHER_TONGUE (LANGUAGE_ID,LANGUAGE_NAME) VALUES (4, 'Bhojpuri');
INSERT INTO HRIS_REC_MOTHER_TONGUE (LANGUAGE_ID,LANGUAGE_NAME) VALUES (5, 'Tamang');
INSERT INTO HRIS_REC_MOTHER_TONGUE (LANGUAGE_ID,LANGUAGE_NAME) VALUES (6, 'Tharu');
INSERT INTO HRIS_REC_MOTHER_TONGUE (LANGUAGE_ID,LANGUAGE_NAME) VALUES (7, 'Maithili');
INSERT INTO HRIS_REC_MOTHER_TONGUE (LANGUAGE_ID,LANGUAGE_NAME) VALUES (8, 'Limbu');
INSERT INTO HRIS_REC_MOTHER_TONGUE (LANGUAGE_ID,LANGUAGE_NAME) VALUES (9, 'Gurung');
INSERT INTO HRIS_REC_MOTHER_TONGUE (LANGUAGE_ID,LANGUAGE_NAME) VALUES (10, 'Rai');
INSERT INTO HRIS_REC_MOTHER_TONGUE (LANGUAGE_ID,LANGUAGE_NAME) VALUES (11, 'Others');


-- Extra queries
select * from hris_rec_documents;

select * from hris_rec_registration;
select * from hris_noc_vacancy_users;


delete rom hris_rec_documents where user_id=1;


update HRIS_REC_VACANCY_OPTIONS set option_id = 2 where vacancy_option_id =2;

SELECT MAX(REG_ID) AS MAXID FROM HRIS_REC_REGISTRATION WHERE USER_ID = 2

SELECT * FROM HRIS_REC_REGISTRATION WHERE AD_NO = 1 AND user_id = 2;

