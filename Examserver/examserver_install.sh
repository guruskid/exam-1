#!/bin/sh
# Copyright (C) <2008> <Shankar Palaniappan>

#This program is free software; you can redistribute it and/or modify
#it under the terms of the GNU General Public License as published by
#the Free Software Foundation; either version 2 of the License, or
#(at your option) any later version.

#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
#GNU General Public License for more details.

#You should have received a copy of the GNU General Public License
#along with this program; if not, write to the Free Software
#Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

#For details or issues with program
#Please contact shankar_p@users.sourceforge.net
#               shankar.palaniappan@gmail.com

var_database=examserv
tmp_file=tmp_file
var_database_file=mysql_examserver.db
serverName=localhost
mysqlshow examserv > /dev/null 2>&1
result=$?
if [ $result -ne 0 ]
then
mysqladmin create $var_database
echo "grant all privileges on $var_database.* to admin@$serverName identified by 'admin' ">$tmp_file
mysql $var_database < mysql_examserver.db
mysql < $tmp_file
rm $tmp_file
echo "Examserv Installation Success !";
else
echo "$var_database already exist"
fi 
