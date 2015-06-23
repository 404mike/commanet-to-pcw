Converting Commanet database
===
Attempt  to convert old commanet database into a format that the [PeoplesCollection](http://www.peoplescollection.wales) API can accept.

# Running the script
Make sure you have [mdb_export](http://linux.die.net/man/1/mdb-export) installed.
Clone the repository.
Run `./commanet.sh /home/mike/commanet/foo.mdb` - the argument passed to the script should be the location of the database.

The script should create directories where the database is stored, these directories will include the generated csv files from the database.

The script will export all the tables from the database, a PHP script will then generate a PCW api spreadsheet from this data.


# Understanding the tables
Understanding the schema of the database is difficult as there is no relationship shown in the sql iteself, here I try and work out what each tables does and to what other tables it connects to.

score
-----
 test

rem
---
test

LPlan
-----
test 

comms
-----
test 

album
-----
test 

albums
------
test
 

audio
-----
test 

passwords
---------
test 

harbour
-------
test 

photo
-----
test 

donor
-----
test 

1
-
test

2
-
test

3
-
test

4
-
test

5
-
test

6
-
test 

7
-
test 

8
-
test

9
-
test

10
--
test

11
--
test

12
--
test

13
--
test

14
--
test

15
--
test

16
--
test

17
--
test

18
--
test

19
--
test

20
--
test 

21
--
test

22
--
test

23
--
test

#SQL Schema


    
    CREATE TABLE `1`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `2`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `3`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `4`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `5`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `6`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `7`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `8`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `9`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `10`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `11`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `12`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `13`
     (
      `recid`     varchar (20), 
      `item`      int, 
      `dDate`     datetime
    );
    
    CREATE TABLE `14`
     (
      `recid`     varchar (20), 
      `item`      varchar (255)
    );
    
    CREATE TABLE `15`
     (
      `recid`     varchar (20), 
      `item`      varchar (255), 
      `Location_Memo` varchar (255)
    );
    
    CREATE TABLE `16`
     (
      `recid`                     varchar (20), 
      `item`                      varchar (255), 
      `x`                         float, 
      `y`                         float, 
      `spotcount`                 int, 
      `spot_ID`                 int, 
      `spot_Type`                 int, 
    `spot_Author`             varchar (255), 
      `spot_Characters_In`      float, 
      `spot_Characters_Long`      float, 
      `spot_Video_Position`     float, 
      `spot_Video_X`              float, 
      `spot_Video_Y`              float, 
      `spot_3d_x`                 float, 
      `spot_3d_y`                 float, 
      `spot_3d_z`                 float, 
      `spot_head`                 varchar (255)
    );
    
    CREATE TABLE `17`
     (
      `recid`     varchar (20), 
      `item`      varchar (255), 
      `Meta_Number` varchar (255), 
      `Meta_Date`   datetime, 
      `Meta_Data`   varchar (255)
    );
    
    CREATE TABLE `18`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `19`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `20`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `21`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `22`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `23`
     (
      `recid`     varchar (20), 
      `item`      int
    );
    
    CREATE TABLE `donor`
     (
      `rec_no`      int, 
      `donor_id`      int, 
      `donor_memo`    varchar (255)
    );
    
    CREATE TABLE `photo`
     (
      `recid`     varchar (20), 
      `donor_id`    int, 
      `photo_file`  varchar (50), 
      `rec_no`    int
    );
    
    CREATE TABLE `harbour`
     (
      `a`      int, 
      `b`      int, 
      `c`      int, 
      `d`      int, 
      `serial`   varchar (20), 
      `version`  varchar (20), 
      `customer`   varchar (255), 
      `copy1`    varchar (255), 
      `superbeing` varchar (8), 
      `NextID`   int, 
      `Nextrecno`  int, 
      `language`   varchar (50)
    );
    
    CREATE TABLE `passwords`
     (
      `name`      varchar (50), 
      `password`    varchar (8)
    );
    
    CREATE TABLE `audio`
     (
      `recid`     varchar (20), 
      `audio_file`  varchar (50)
    );
    
    CREATE TABLE `albums`
     (
      `albumID`   varchar (20), 
      `Title`     varchar (255)
    );
    
    CREATE TABLE `album`
     (
      `albumID`   varchar (20), 
      `recid`     varchar (20), 
      `status`    varchar (20)
    );
    
    CREATE TABLE `comms`
     (
      `AlbumID`   varchar (20), 
      `recid`     varchar (20), 
      `commtext`    varchar (255)
    );
    
    CREATE TABLE `LPlan`
     (
      `AlbumID`   varchar (20), 
      `recid`     varchar (20), 
      `status`    varchar (20), 
      `plan_position` int
    );
    
    CREATE TABLE `rem`
     (
      `recid`     varchar (20), 
      `rem`     text (255), 
      `author`    varchar (50), 
      `rem_ID`    int, 
      `RemType`   varchar (50), 
      `RemText`   text (255)
    );
    
    CREATE TABLE `score`
     (
      `recid`   varchar (20)
    );


