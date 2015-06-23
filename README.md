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
 Not sure - album id?

rem
---
Table that holds information about the author and description for the image.
      `recid`  - Image id
      `rem`    - Doesn't look useful
      `author` - author of the image
      `rem_ID` - not sure
      `RemType`- empty
      `RemText`- Image description

LPlan
-----
Not sure 

comms
-----
Album details? 

album
-----
Album images. First column looks to be the album id and second column looks to be the iamge id. 

albums
------
Probably album title
 
audio
-----
No audio in the test files, looks like a id and filename of audio file 

passwords
---------
Don't know why they have this, ignore it. 

harbour
-------
Doesn't look like anything relevant to us. 

photo
-----
Table that connects item id to item filename 

donor
-----
Looks to be a table to conect userid to username 

1
-
Not sure

2
-
Not sure

3
-
Not sure

4
-
Not sure

5
-
Not sure

6
-
Not sure 

7
-
Not sure 

8
-
Not sure

9
-
Not sure

10
--
Not sure

11
--
Not sure

12
--
Not sure

13
--
Contains dates for the image
      `recid`     varchar (20), 
      `item`      int, 
      `dDate`     datetime

14
--
Not sure what this does, has true or false values - 0|1

15
--
Possibly location name

16
--
Looks to hold tagging coordinates

17
--
Looks to contain the title for the image
      `recid`     varchar (20), 
      `item`      varchar (255), 
      `Meta_Number` varchar (255), 
      `Meta_Date`   datetime, 
      `Meta_Data`   varchar (255)

18
--
Not sure

19
--
Not sure

20
--
Not sure 

21
--
Not sure

22
--
Not sure

23
--
Not sure

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


