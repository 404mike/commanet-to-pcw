#!/bin/bash
# @autho Michael Jones - mij@llgc.org.uk
# @date 23/06/2015
# Convert old commanet database to csv
# Uses http://linux.die.net/man/1/mdb-export
# make sure mdb-export is installed before running the script

# Check to see if there were any parameters passed
# @param string path and file name to mdb
if [ "$1" != "" ]; then
  mdb_path="$1"
else
  # No parameter provided, display message and exit
  echo "File path required e.g. /home/foo/commanet/foo.mdb"
  exit 1
fi

# create a directory to store the csv files
# Get the last item in the filepath
dirname=${mdb_path%/*}
# Create path to csv dir
csv_dir="$dirname/csv"
echo "Creating CSV directory"
# Create csv dir
mkdir -p "$csv_dir"

# Create an array of all the tables in the mdb database
array=( score rem LPlan comms album albums audio passwords harbour photo donor 
        1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 19 20 21 22 23 )
# Loop through each table and convert to a csv
# place all the csvs in the csv directory
echo "Looping through all the tables, creating csv files"
for i in "${array[@]}"
do
  mdb-export $mdb_path $i > $csv_dir/$i.csv
done

echo "Creating CSV file for PCW upload"
# Run php script to convert the csv to pcw spredsheet
# pass path to csv directory as a parameter
php transform.php $csv_dir