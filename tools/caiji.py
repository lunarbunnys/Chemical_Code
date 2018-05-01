from bs4 import BeautifulSoup
import requests
import sys
import MySQLdb
import types
reload(sys)
sys.setdefaultencoding('utf-8')
db = MySQLdb.connect("localhost","root","root","23" )
for i in range(200):
    i = (i+1)*100
    print "START "+str(i)
    url = "http://www.chemicalbook.com/CASDetailList_"+str(i)+".htm"
    r= requests.get(url)
    soup = BeautifulSoup(r.text)
    L=[]
    R=[]
    for c in soup.find_all(id='ContentPlaceHolder1_ProductClassDetail')[0].children:
        soup1 = BeautifulSoup(str(c))
        if(type(soup1.span ) is not types.NoneType):
            R.append(soup1.span .string)
        if(type(soup1.a ) is not types.NoneType):
            L.append(soup1.a .string)
    for m in range(len(L)):
        cas =  L[m]
        anwser = R[m]
        cursor = db.cursor()
        sql = "INSERT INTO `sd_vcode` (`id`, `cas`, `anwser`) VALUES (NULL, '"+cas+"', '"+anwser+"');"
        cursor.execute(sql)
        db.commit()
    L=[]
    R=[]
