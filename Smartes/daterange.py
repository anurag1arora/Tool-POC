#!C:/Users/agyapal.singh/AppData/Local/Continuum/anaconda3/python.exe
import cgi;
import cgitb;
import pandas as pd;
import datetime;
import json;
import psycopg2
from datetime import date

cgitb.enable()
print("Content-Type: text/html")
print("")
print("<html><head>")
print("")
print("</head><body>")



form = cgi.FieldStorage()

 
sname= form.getvalue("scripname")
mylist=[form.getvalue("scripname")]
startDateString=form.getvalue("startdate")
format_str = '%d-%m-%y'
startDate = datetime.datetime.strptime(startDateString, format_str)
endDateString=form.getvalue("enddate")
endDate = datetime.datetime.strptime(endDateString, format_str)


wdays='Mon Tue Wed Thu Fri'
start=startDate
end=endDate


conn = psycopg2.connect("dbname=NSEEQ user=postgres password=Password16 host=localhost")
cur = conn.cursor()
cur.execute("select date from nse_cm where scrip= %s and date between %s and  %s",(sname,start,end))
dbdays=cur.rowcount
cur.execute("select date from holiday")
row=cur.fetchone()
hd=[]
while row is not None:
    hd.append(row)
    row=cur.fetchone()
conn.close()

hdays=[]
for i in range(len(hd)):
    hdays.append(hd[i][0])

k=pd.bdate_range(start,end,freq='C', weekmask=wdays, holidays=hdays)
tdays=k.size

if (tdays-dbdays)==0:
	flag=0
else:
	flag=1
	
	
#flg={"Flag":flag}
flg=flag
print(json.dumps(flg))

print("</body></html>")