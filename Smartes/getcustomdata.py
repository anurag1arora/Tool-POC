#!C:/Users/agyapal.singh/AppData/Local/Continuum/anaconda3/python.exe
import cgi;
import cgitb;
import pandas as pd;
import datetime;
import json;
import psycopg2
from datetime import date
from nsepy import get_history
import sqlalchemy
cgitb.enable()
print("Content-Type: text/html")
print("")
print("<html><head>")
print("")
print("</head><body>")


form = cgi.FieldStorage()
mylist=[form.getvalue("scripname")]
form.filename
#print(mylist)
startDateString=form.getvalue("startdate")
format_str = '%d-%m-%y'
startDate = datetime.datetime.strptime(startDateString, format_str)
endDateString=form.getvalue("enddate")
endDate = datetime.datetime.strptime(endDateString, format_str)
#startDate =form.getvalue("startdate")
#endDate =form.getvalue("enddate")
df1=df=df2=pd.DataFrame()
flag=1
for i in mylist:
    df = get_history(symbol=i,start=startDate, end=endDate)
    df1 = df1.append(df)
    
df1['Date'] = df1.index
df1= df1.reset_index(drop=True)
df2=df1.loc[:,['Date','Symbol','Close','High','Low','Open']]
df2.columns=['date','scrip','close','high','low','open']


if df.empty:
    flag=0
 


conn=None

if flag!=0:
	try:
	    #writing data to temp table
	    #print("try")
	    engine = sqlalchemy.create_engine('postgresql://postgres:Password16@localhost:5432/NSEEQ')
	    df2.to_sql(name="temp",con=engine,index=False,if_exists='append')
	    
	    #INSERTING ONLY NEW DATA IN STOCKDATA TABLE
	    conn = psycopg2.connect("dbname=NSEEQ user=postgres password=Password16 host=localhost")
	    cur = conn.cursor()
	    cur.execute("INSERT INTO nse_cm(date,scrip,close,high,low,open)(select * from temp Except select * from nse_cm)")
	    #print("SQL1")
	    cur.execute("DELETE FROM temp")
	    #print("SQL2")
	    conn.commit()
	    cur.close()
	    flag=1
	    
	except (Exception, psycopg2.DatabaseError) as error:
	    print(error)
	    flag=2
	    
	finally:
	    if conn is not None:
	        
	        #data={}
	        #data['Scrip']=mylist
	        #json_data=json.dumps(data)
	        #print(json_data)
	        conn.close()

#flg={"Flag":flag}
flg=flag
#print('<p id="resp">')
print(json.dumps(flg))
print("</body></html>")