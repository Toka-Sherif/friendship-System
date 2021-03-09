--CREATE DATABASE If NOT EXISTS trail1;
--USE trail1;
CREATE TABLE If NOT EXISTS `user` (
    `email`  varchar(100) primary key,
    fname varchar(25),
    lname varchar(25),
    password varchar(10),
    number int(10),
    gender varchar(10),
    bdate date,
    pp varchar(255),
    hometown varchar(100),
    mstatus varchar(25),
    about varchar(1000)
);
CREATE TABLE If NOT EXISTS post (
    email	varchar(100),
    caption	varchar(255),
    postername	varchar(255),
    Image	varchar(255),
    postedtime	timestamp,
    ispublic	varchar(20)
);
CREATE TABLE If NOT EXISTS f_requests (
    email	varchar(100),
    f_request_email	varchar(100)
);
CREATE TABLE If NOT EXISTS friends (
    email	varchar(100),
    friend_email	varchar(100)	
);